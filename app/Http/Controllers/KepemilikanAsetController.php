<?php

namespace App\Http\Controllers;

use App\Http\Requests\KepemilikanAsetRequest;
use App\Models\KepemilikanAset;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KepemilikanAsetController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:kepemilikanAset.index|kepemilikanAset.store|kepemilikanAset.update|kepemilikanAset.del');
    }

    public function index() {
        $data_kepemilikan_aset = KepemilikanAset::orderBy('updated_at', 'desc')->paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('kepemilikanAset.index', ['data_kepemilikan_aset' => $data_kepemilikan_aset]);
    }

    public function store(KepemilikanAsetRequest $request) {
        KepemilikanAset::create([
            'nama' => $request->nama,
            'prefix' => $request->prefix,
        ]);

        Alert::success('Tersimpan!', 'Berhasil menyimpan kepemilikan aset baru');

        return redirect(route('kepemilikanAset.index'));
    }

    public function update($id, KepemilikanAsetRequest $request) {
        KepemilikanAset::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah data kepemilikan aset');

        return redirect(route('kepemilikanAset.index'));
    }

    public function del($id) {
        KepemilikanAset::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus kepemilikan aset');

        return redirect(route('kepemilikanAset.index'));
    }
}
