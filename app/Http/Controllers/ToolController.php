<?php

namespace App\Http\Controllers;

use App\Helpers\AsetHelper;
use App\Http\Requests\ToolRequest;
use App\Models\Aset;
use App\Models\Gudang;
use App\Models\KepemilikanAset;
use App\Models\Tool;
use App\Models\ToolsGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;

class ToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:tools.index|tools.store|tools.storeExist|tools.detail|tools.edit|tools.update|tools.del');
    }

    public function index() {
        $data_tools_group = ToolsGroup::all();
        $data_gudang = Gudang::all();
        $data_kepemilikan_aset = KepemilikanAset::all();
        $data_tool = Tool::orderBy('updated_at', 'desc')->paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('tool.index', ['data_tool' => $data_tool, 'data_tools_group' => $data_tools_group, 'data_gudang' => $data_gudang, 'data_kepemilikan_aset' => $data_kepemilikan_aset]);
    }

    public function store(ToolRequest $request) {
        $kode_aset = AsetHelper::createKodeAset($request->kepemilikan_aset);

        $aset = Aset::create([
            'kode_aset' => $kode_aset,
            'tipe_aset' => 'tool',
            'id_kepemilikan_aset' => $request->kepemilikan_aset,
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

        $this->updateStatistik($aset->id);

        Alert::success('Tersimpan!', 'Berhasil menambahkan tool baru');

        return redirect(route('tools.index'));
    }

    public function storeExist(ToolRequest $request) {
        $prefix = explode('-', $request->kode_aset);
        $kepemilikan_aset = null;
        if(isset($prefix[1])) {
            $kepemilikan_aset = KepemilikanAset::where('prefix', $prefix[1])->first()->id;
        }

        $aset = Aset::create([
            'kode_aset' => $request->kode_aset,
            'tipe_aset' => 'tool',
            'id_kepemilikan_aset' => $kepemilikan_aset,
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

        $this->updateStatistik($aset->id);

        Alert::success('Tersimpan!', 'Berhasil menambahkan tool');

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
        $tool = Tool::where('id', $id)->first();

        Aset::where('id', $tool->id_aset)->delete();
        $tool->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus tool');

        return redirect(route('tools.index'));
    }

    protected function updateStatistik($id_aset)
    {
        Artisan::call('reporting:statistik-penggunaan-aset', [
            '--aset' => $id_aset,
        ]);
    }
}
