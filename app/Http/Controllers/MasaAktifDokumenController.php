<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasaAktifDokumenRequest;
use App\Models\Kendaraan;
use App\Models\MasaAktifDokumenKendaraan;
use App\Models\TelegramData;
use App\Models\TipeDokumenKendaraan;
use App\Notifications\DeadlineMAsaAktifDokumenNotification;
use App\Notifications\ReminderMasaAktifDokumenNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class MasaAktifDokumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:masaAktifDokumen.index|masaAktifDokumen.getKendaraan|masaAktifDokumen.store|masaAktifDokumen.update|masaAktifDokumen.del');
    }

    public function index() {
        $kendaraan = Kendaraan::orderByRaw('-tanggal_perbarui_dokumen DESC')->paginate(10);

        return view('masaAktif.index', ['data_kendaraan' => $kendaraan]);
    }

    public function getKendaraan($id_kendaraan) {
        $kendaraan = Kendaraan::find($id_kendaraan);
        $tipe_dokumen = TipeDokumenKendaraan::all();

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('masaAktif.show', ['data_kendaraan' => $kendaraan, 'data_tipe_dokumen' => $tipe_dokumen]);
    }

    public function store($id_kendaraan, MasaAktifDokumenRequest $request) {
        $masa_aktif_dokumen = MasaAktifDokumenKendaraan::create([
            'id_kendaraan' => $id_kendaraan,
            'id_tipe_dokumen' => $request->tipe_dokumen,
            'tanggal_masa_berlaku' => $request->masa_aktif
        ]);

        $telegram = TelegramData::where('tipe', 'channel')->first();
        if($telegram->id_telegram != null) {
            Notification::send($telegram->id_telegram, (new ReminderMasaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)->subDays(7)));
            Notification::send($telegram->id_telegram, (new DeadlineMAsaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)));
        }
        else {
            Notification::send($telegram->username, (new ReminderMasaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)->subDays(7)));
            Notification::send($telegram->username, (new DeadlineMAsaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)));
        }

        Alert::success('Tersimpan!', 'Berhasil menambahkan dokumen kendaraan baru');

        return redirect(route('masaAktifDokumen.getKendaraan', $id_kendaraan));
    }

    public function update($id_kendaraan, $id, MasaAktifDokumenRequest $request) {
        MasaAktifDokumenKendaraan::where('id', $id)->update([
            'tanggal_masa_berlaku' => $request->masa_aktif
        ]);

        Kendaraan::where('id', $id_kendaraan)->update([
            'tanggal_perbarui_dokumen' => null,
        ]);

        Artisan::call('kendaraan:cek-masa-aktif-dokumen');

        $masa_aktif_dokumen = MasaAktifDokumenKendaraan::find($id);
        $telegram = TelegramData::where('tipe', 'channel')->first();
        if($telegram->id_telegram != null) {
            Notification::send($telegram->id_telegram, (new ReminderMasaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)->subDays(7)));
            Notification::send($telegram->id_telegram, (new DeadlineMAsaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)));
        }
        else {
            Notification::send($telegram->username, (new ReminderMasaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)->subDays(7)));
            Notification::send($telegram->username, (new DeadlineMAsaAktifDokumenNotification($masa_aktif_dokumen))->delay(Carbon::parse($masa_aktif_dokumen->tanggal_masa_berlaku)));
        }

        Alert::success('Tersimpan!', 'Berhasil memperbaru masa aktif dokumen');

        return redirect(route('masaAktifDokumen.getKendaraan', $id_kendaraan));
    }

    public function del($id_kendaraan, $id) {
        MasaAktifDokumenKendaraan::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus dokumen kendaraan');

        return redirect(route('masaAktifDokumen.getKendaraan', $id_kendaraan));
    }
}
