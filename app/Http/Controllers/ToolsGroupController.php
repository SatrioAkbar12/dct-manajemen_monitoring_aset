<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToolsGroupRequest;
use App\Models\ToolsGroup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ToolsGroupController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:toolsGroup.index|toolsGroup.store|toolsGroup.update|toolsGroup.del');
    }

    public function index() {
        $data_grup = ToolsGroup::orderBy('updated_at', 'desc')->paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('toolsGroup.index', ['data_grup' => $data_grup]);
    }

    public function store(ToolsGroupRequest $request) {
        ToolsGroup::create([
            'nama' => $request->nama,
        ]);

        Alert::success('Tersimpan!', 'Berhasil menambahkan tools group baru');

        return redirect(route('toolsGroup.index'));
    }

    public function update($id, ToolsGroupRequest $request) {
        ToolsGroup::where('id', $id)->update([
            'nama' => $request->nama,
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah tools group');

        return redirect(route('toolsGroup.index'));
    }

    public function del($id) {
        ToolsGroup::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus tools group');

        return redirect(route('toolsGroup.index'));
    }
}
