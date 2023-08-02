<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeDokumenKendaraan;

class DokumenController extends Controller
{
    public function index() {
        $data = TipeDokumenKendaraan::paginate(10);

        return view('dokumen.index', ['data' => $data]);
    }

    public function store(Request $request) {
        TipeDokumenKendaraan::create([
            'nama_dokumen' => $request->nama
        ]);

        return redirect('/tipe-dokumen');
    }

    public function show($id) {
        $data = TipeDokumenKendaraan::find($id);

        return view('dokumen.update', ['data' => $data]);
    }

    public function update($id, Request $request) {
        TipeDokumenKendaraan::where('id', $id)->update([
            'nama_dokumen' => $request->nama
        ]);

        return redirect('/tipe-dokumen');
    }

    public function del($id) {
        TipeDokumenKendaraan::where('id', $id)->delete();

        return redirect('/tipe-dokumen');
    }
}
