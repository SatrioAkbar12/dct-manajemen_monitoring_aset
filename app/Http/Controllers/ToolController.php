<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToolRequest;
use App\Models\Aset;
use App\Models\Gudang;
use App\Models\Tool;
use App\Models\ToolsGroup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:tools.index|tools.store|tools.detail|tools.edit|tools.update|tools.del');
    }

    public function index() {
        $data_tools_group = ToolsGroup::all();
        $data_gudang = Gudang::all();
        $data_tool = Tool::orderBy('updated_at', 'desc')->paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('tool.index', ['data_tool' => $data_tool, 'data_tools_group' => $data_tools_group, 'data_gudang' => $data_gudang]);
    }

    public function store(ToolRequest $request) {
        $prefix_grup = $request->tools_group;
        if(intval($prefix_grup) < 10) {
            $prefix_grup = '0' . $prefix_grup;
        }
        $kode_aset = 'TOOL' . $prefix_grup;

        $aset = Aset::where('kode_aset', 'like',  $kode_aset . '%')->orderBy('id', 'desc')->first();
        $id = 1;
        if($aset != null) {
            $id = intval(substr($aset->kode_aset, -3)) + 1;
        }

        if($id < 10) {
            $kode_aset = $kode_aset . "00" . $id;
        }
        else {
            $kode_aset = $kode_aset . "0" . $id;
        }

        $aset = Aset::create([
            'kode_aset' => $kode_aset,
            'tipe_aset' => 'tool',
        ]);

        Tool::create([
            'id_aset' => $aset->id,
            'nama' => $request->nama,
            'merk' => $request->merk,
            'model' => $request->model,
            'deskripsi' => $request->deskripsi,
            'status_saat_ini' => 'Di gudang',
            'id_tools_group' => $request->tools_group,
            'id_gudang' => $request->gudang,
        ]);

        Alert::success('Tersimpan!', 'Berhasil menambahkan tool baru');

        return redirect(route('tools.index'));
    }

    public function detail($id) {
        $data_tool = Tool::find($id);

        return view('tool.detail', ['data_tool' => $data_tool]);
    }

    public function edit($id) {
        $data_tool = Tool::find($id);
        $data_tools_group = ToolsGroup::all();
        $data_gudang = Gudang::all();

        return view('tool.edit', ['data_tool' => $data_tool, 'data_tools_group' => $data_tools_group, 'data_gudang' => $data_gudang]);
    }

    public function update($id, ToolRequest $request) {
        Tool::where('id', $id)->update([
            'nama' => $request->nama,
            'nama' => $request->nama,
            'merk' => $request->merk,
            'model' => $request->model,
            'deskripsi' => $request->deskripsi,
            'id_tools_group' => $request->tools_group,
            'id_gudang' => $request->gudang,
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah data tool');

        return redirect(route('tools.index'));
    }

    public function del($id) {
        Tool::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus tool');

        return redirect(route('tools.index'));
    }
}
