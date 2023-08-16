<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipeDokumenRequest;
use Illuminate\Http\Request;
use App\Models\TipeDokumenKendaraan;
use RealRashid\SweetAlert\Facades\Alert;

class DokumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tipeDokumen.index|tipeDokumen.store|tipeDokumen.show|tipeDokumen.update|tipeDokumen.del');
    }

    public function index() {
        $data = TipeDokumenKendaraan::orderBy('updated_at', 'desc')->paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('dokumen.index', ['data' => $data]);
    }

    public function store(TipeDokumenRequest $request) {
        TipeDokumenKendaraan::create([
            'nama_dokumen' => $request->nama
        ]);

        Alert::success('Tersimpan!', 'Berhasil menambahkan tipe dokumen baru');

        return redirect(route('tipeDokumen.index'));
    }

    public function show($id) {
        $data = TipeDokumenKendaraan::find($id);

        return view('dokumen.update', ['data' => $data]);
    }

    public function update($id, TipeDokumenRequest $request) {
        TipeDokumenKendaraan::where('id', $id)->update([
            'nama_dokumen' => $request->nama
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah data tipe dokumen');

        return redirect(route('tipeDokumen.index'));
    }

    public function del($id) {
        TipeDokumenKendaraan::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus tipe dokumen');

        return redirect(route('tipeDokumen.index'));
    }
}
