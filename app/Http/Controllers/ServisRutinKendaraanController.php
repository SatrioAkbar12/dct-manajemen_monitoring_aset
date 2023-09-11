<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServisRutinKendaraanRequest;
use App\Models\Kendaraan;
use App\Models\ServisRutinKendaraan;
use App\Models\TelegramData;
use App\Notifications\TanggalServisRutinKendaraanNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class ServisRutinKendaraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:servisRutin.index|servisRutin.getKendaraan|servisRutin.store');
    }

    public function index() {
        $kendaraan = Kendaraan::orderBy('perlu_servis', 'desc')->paginate(10);

        return view('servisRutin.index', ['data_kendaraan' => $kendaraan]);
    }

    public function getKendaraan($id_kendaraan) {
        $kendaraan = Kendaraan::find($id_kendaraan);
        $servis = ServisRutinKendaraan::where('id_kendaraan', $id_kendaraan)->orderBy('tanggal_servis', 'desc')->get();
        $jumlah_servis = count($servis);

        return view('servisRutin.show', ['data_kendaraan' => $kendaraan, 'data_servis' => $servis, 'jumlah_servis' => $jumlah_servis]);
    }

    public function store($id_kendaraan, ServisRutinKendaraanRequest $request) {
        $km_target = $request->km_target;
        if($km_target == null) {
            $km_target = ServisRutinKendaraan::where('id_kendaraan', $id_kendaraan)->orderBy('km_target', 'desc')->first('km_target')->km_target + 10000;
        }

        $tanggal_target = Carbon::parse($request->tanggal_servis, 'Asia/Jakarta')->addMonths(6);

        $servis = ServisRutinKendaraan::create([
            'id_kendaraan' => $id_kendaraan,
            'tanggal_servis' => $request->tanggal_servis,
            'km_target' => $km_target,
            'tanggal_target' => $tanggal_target,
            'detail_servis' => $request->detail_servis,
        ]);

        Kendaraan::where('id', $id_kendaraan)->update([
            'perlu_servis' => 0,
        ]);

        $telegram = TelegramData::where('tipe', 'channel')->first();
        if($telegram->id_telegram != null) {
            Notification::send($telegram->id_telegram, (new TanggalServisRutinKendaraanNotification($servis))->delay(Carbon::parse($servis->tanggal_target)));
        }
        else {
            Notification::send($telegram->username, (new TanggalServisRutinKendaraanNotification($servis))->delay(Carbon::parse($servis->tanggal_target)));
        }

        Alert::success('Tersimpan!', 'Berhasil menambahkan data servis rutin baru');

        return redirect(route('servisRutin.getKendaraan', $id_kendaraan));
    }
}
