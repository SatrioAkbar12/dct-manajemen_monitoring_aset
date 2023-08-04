<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\MasaAktifDokumenKendaraan;
use App\Models\TipeDokumenKendaraan;
use Illuminate\Http\Request;

class MasaAktifDokumenController extends Controller
{
    public function index() {
        $kendaraan = Kendaraan::paginate(10);

        return view('masaAktif.index', ['data_kendaraan' => $kendaraan]);
    }

    public function getKendaraan($id_kendaraan) {
        $kendaraan = Kendaraan::find($id_kendaraan);
        $tipe_dokumen = TipeDokumenKendaraan::all();

        return view('masaAktif.show', ['data_kendaraan' => $kendaraan, 'data_tipe_dokumen' => $tipe_dokumen]);
    }

    public function store($id_kendaraan, Request $request) {
        MasaAktifDokumenKendaraan::create([
            'id_kendaraan' => $id_kendaraan,
            'id_tipe_dokumen' => $request->tipe_dokumen,
            'tanggal_masa_berlaku' => $request->masa_aktif
        ]);

        return redirect('/masa-aktif-dokumen/' . $id_kendaraan);
    }

    public function update($id_kendaraan, $id, Request $request) {
        MasaAktifDokumenKendaraan::where('id', $id)->update([
            'tanggal_masa_berlaku' => $request->masa_aktif
        ]);

        return redirect('/masa-aktif-dokumen/' . $id_kendaraan);
    }

    public function del($id_kendaraan, $id) {
        MasaAktifDokumenKendaraan::where('id', $id)->delete();

        return redirect('/masa-aktif-dokumen/' . $id_kendaraan);
    }
}
