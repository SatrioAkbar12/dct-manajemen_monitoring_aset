<?php

namespace App\Http\Controllers;

use App\Helpers\AsetHelper;
use App\Http\Requests\KendaraanRequest;
use App\Models\Aset;
use App\Models\JenisKendaraan;
use App\Models\Kendaraan;
use App\Models\KepemilikanAset;
use App\Models\ServisRutinKendaraan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KendaraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kendaraan.index|kendaraan.store|kendaraan.show|kendaraan.update|kendaraan.del');
    }

    public function index() {
        $data = Kendaraan::orderBy('updated_at', 'desc')->paginate(10);
        $data_jenis_kendaraan = JenisKendaraan::all();
        $data_kepemilikan_aset = KepemilikanAset::all();

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('kendaraan.index', ['data' => $data, 'data_jenis_kendaraan' => $data_jenis_kendaraan, 'data_kepemilikan_aset' => $data_kepemilikan_aset]);
    }

    public function store(KendaraanRequest $request) {
        $kode_aset = AsetHelper::createKodeAset($request->kepemilikan_aset);

        $aset = Aset::create([
            'kode_aset' => $kode_aset,
            'tipe_aset' => 'kendaraan',
            'id_kepemilikan_aset' => $request->kepemilikan_aset,
        ]);

        $kendaraan = Kendaraan::create([
            'nopol' => $request->nopol,
            'merk' => $request->merk,
            'id_jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'tipe' => $request->tipe,
            'km_saat_ini' => $request->km_saat_ini,
            'id_aset' => $aset->id,
        ]);

        ServisRutinKendaraan::create([
            'id_kendaraan' => $kendaraan->id,
            'tanggal_servis' => $request->tanggal_servis_terakhir,
            'km_target' => $request->km_target_servis,
            'tanggal_target' => Carbon::parse($request->tanggal_servis_terakhir, 'Asia/Jakarta')->addMonths(6),
            'detail_servis' => 'Awal input servis rutin kendaraan',
        ]);

        Alert::success('Tersimpan!', 'Berhasil menambahkan kendaraan baru');

        return redirect(route('kendaraan.index'));
    }

    public function show($id) {
        $data = Kendaraan::find($id);
        $data_jenis_kendaraan = JenisKendaraan::all();

        return view('kendaraan.update', ['data' => $data, 'data_jenis_kendaraan' => $data_jenis_kendaraan]);
    }

    public function update($id, KendaraanRequest $request) {
        Kendaraan::where('id', $id)->update([
            'nopol' => $request->nopol,
            'merk' => $request->merk,
            'id_jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna,
            'tipe' => $request->tipe,
            'km_saat_ini' => $request->km_saat_ini,
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah data kendaraan');

        return redirect(route('kendaraan.index'));
    }

    public function del($id) {
        $kendaraan = Kendaraan::where('id', $id)->first();

        Aset::where('id', $kendaraan->id_aset)->delete();
        $kendaraan->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus kendaraan');

        return redirect(route('kendaraan.index'));
    }
}
