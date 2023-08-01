<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index() {
        $data = Kendaraan::all();

        return view('kendaraan.index', ['data' => $data]);
    }

    public function store(Request $request) {
        Kendaraan::create([
            'nopol' => $request->nopol,
            'merk' => $request->merk,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna
        ]);

        return redirect('/kendaraan');
    }

    public function show($id) {
        $data = Kendaraan::find($id);

        return view('kendaraan.update', ['data' => $data]);
    }

    public function update($id, Request $request) {
        Kendaraan::where('id', $id)->update([
            'nopol' => $request->nopol,
            'merk' => $request->merk,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna' => $request->warna
        ]);

        return redirect('/kendaraan');
    }

    public function del($id) {
        Kendaraan::where('id', $id)->delete();

        return redirect('/kendaraan');
    }
}
