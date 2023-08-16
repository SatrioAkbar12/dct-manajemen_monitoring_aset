<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisKendaraanRequest;
use App\Models\JenisKendaraan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JenisKendaraanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:jenisKendaraan.index|jenisKendaraan.store|jenisKendaraan.update|jenisKendaraan.delete');
    }

    public function index() {
        $data = JenisKendaraan::paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('jenisKendaraan.index', ['data' => $data]);
    }

    public function store(JenisKendaraanRequest $request) {
        JenisKendaraan::create([
            'nama' => $request->nama
        ]);

        Alert::success('Tersimpan!', 'Berhasil menambahkan jenis kendaraan baru');

        return redirect(route('jenisKendaraan.index'));
    }

    public function update($id, JenisKendaraanRequest $request) {
        JenisKendaraan::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah data jenis kendaraan');

        return redirect(route('jenisKendaraan.index'));
    }

    public function del($id) {
        JenisKendaraan::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus jenis kendaraan');

        return redirect(route('jenisKendaraan.index'));
    }
}
