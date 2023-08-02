<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class ServisRutinKendaraanController extends Controller
{
    public function index() {
        $kendaraan = Kendaraan::all();

        return view('servisRutin.index', ['data_kendaraan' => $kendaraan]);
    }
}
