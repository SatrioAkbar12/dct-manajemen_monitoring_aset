<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServisRutinKendaraanRequest;
use App\Models\Kendaraan;
use App\Models\ServisRutinKendaraan;
use Illuminate\Http\Request;

class ServisRutinKendaraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:servisRutin.index|servisRutin.getKendaraan|servisRutin.store');
    }

    public function index() {
        $kendaraan = Kendaraan::paginate(10);

        return view('servisRutin.index', ['data_kendaraan' => $kendaraan]);
    }

    public function getKendaraan($id_kendaraan) {
        $kendaraan = Kendaraan::find($id_kendaraan);
        $servis = ServisRutinKendaraan::where('id_kendaraan', $id_kendaraan)->orderBy('tanggal_servis', 'desc')->get();
        $jumlah_servis = count($servis);

        return view('servisRutin.show', ['data_kendaraan' => $kendaraan, 'data_servis' => $servis, 'jumlah_servis' => $jumlah_servis]);
    }

    public function store($id_kendaraan, ServisRutinKendaraanRequest $request) {
        ServisRutinKendaraan::create([
            'id_kendaraan' => $id_kendaraan,
            'tanggal_servis' => $request->tanggal_servis,
            'penggantian_oli' => $request->penggantian_oli == 'on' ? 1 : 0,
            'cek_aki' => $request->cek_aki == 'on' ? 1 : 0,
            'cek_rem' => $request->cek_rem == 'on' ? 1 : 0,
            'cek_kopling' => $request->cek_kopling == 'on' ? 1 : 0,
            'cek_ban' => $request->cek_ban == 'on' ? 1 : 0,
            'cek_lampu' => $request->cek_lampu == 'on' ? 1 : 0,
            'cek_ac' => $request->cek_ac == 'on' ? 1 : 0
        ]);

        return redirect('/servis-rutin/' . $id_kendaraan);
    }
}
