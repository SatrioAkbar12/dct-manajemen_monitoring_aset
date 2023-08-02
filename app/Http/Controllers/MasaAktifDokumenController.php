<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\MasaAktifDokumenKendaraan;
use App\Models\TipeDokumenKendaraan;
use Illuminate\Http\Request;

class MasaAktifDokumenController extends Controller
{
    public function index() {
        $masa_aktif = MasaAktifDokumenKendaraan::all();
        $dokumen = TipeDokumenKendaraan::all();
        $kendaraan = Kendaraan::all();

        return view('masaAktif.index', ['data_masa_aktif' => $masa_aktif, 'data_dokumen' => $dokumen, 'data_kendaraan' => $kendaraan]);
    }
}
