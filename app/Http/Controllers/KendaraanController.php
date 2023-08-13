<?php

namespace App\Http\Controllers;

use App\Http\Requests\KendaraanRequest;
use App\Models\Aset;
use App\Models\JenisKendaraan;
use App\Models\Kendaraan;
use App\Models\ServisRutinKendaraan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kendaraan.index|kendaraan.store|kendaraan.show|kendaraan.update|kendaraan.del');
    }

    public function index() {
        $data = Kendaraan::orderBy('updated_at', 'desc')->paginate(10);
        $data_jenis_kendaraan = JenisKendaraan::all();

        return view('kendaraan.index', ['data' => $data, 'data_jenis_kendaraan' => $data_jenis_kendaraan]);
    }

    public function store(KendaraanRequest $request) {
        $prefix_jenis_kendaraan = $request->jenis_kendaraan;
        if(intval($prefix_jenis_kendaraan) < 10) {
            $prefix_jenis_kendaraan = '0' . $prefix_jenis_kendaraan;
        }
        $kode_aset = 'TRAN' . $prefix_jenis_kendaraan;

        $aset = Aset::where('kode_aset', 'like',  $kode_aset . '%')->orderBy('id', 'desc')->first();
        $id = 1;
        if($aset != null) {
            $id = intval(substr($aset->kode_aset, -3)) + 1;
        }

        if($id < 10) {
            $kode_aset = $kode_aset . "00" . $id;
        }
        else {
            $kode_aset = $kode_aset . "0" . $id;
        }

        $aset = Aset::create([
            'kode_aset' => $kode_aset,
            'tipe_aset' => 'kendaraan',
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

        return redirect(route('kendaraan.index'));
    }

    public function del($id) {
        Kendaraan::where('id', $id)->delete();

        return redirect(route('kendaraan.index'));
    }
}
