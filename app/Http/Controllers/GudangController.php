<?php

namespace App\Http\Controllers;

use App\Http\Requests\GudangRequest;
use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:gudang.index|gudang.store|gudang.update|gudang.del');
    }

    public function index() {
        $data_gudang = Gudang::orderBy('updated_at', 'desc')->paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('gudang.index', ['data_gudang' => $data_gudang]);
    }

    public function store(GudangRequest $request) {
        Gudang::create([
            'nama' => $request->nama,
        ]);

        return redirect(route('gudang.index'));
    }

    public function update($id, GudangRequest $request) {
        Gudang::where('id', $id)->update([
            'nama' => $request->nama,
        ]);

        return redirect(route('gudang.index'));
    }

    public function del($id) {
        Gudang::where('id', $id)->delete();

        return redirect(route('gudang.index'));
    }
}
