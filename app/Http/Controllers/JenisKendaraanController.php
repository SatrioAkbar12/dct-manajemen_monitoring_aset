<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisKendaraanRequest;
use App\Models\JenisKendaraan;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission::jenisKendaraan.index|jenisKendaraan.store|jenisKendaraan.update|jenisKendaraan.delete');
    }

    public function index() {
        $data = JenisKendaraan::paginate(10);

        return view('jenisKendaraan.index', ['data' => $data]);
    }

    public function store(JenisKendaraanRequest $request) {
        JenisKendaraan::create([
            'nama' => $request->nama
        ]);

        return redirect(route('jenisKendaraan.index'));
    }

    public function update($id, JenisKendaraanRequest $request) {
        JenisKendaraan::where('id', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect(route('jenisKendaraan.index'));
    }

    public function del($id) {
        JenisKendaraan::where('id', $id)->delete();

        return redirect(route('jenisKendaraan.index'));
    }
}
