<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanAktifToolRequest;
use App\Models\Gudang;
use App\Models\KondisiToolsTransaksiPeminjaman;
use App\Models\ListToolsTransaksiPeminjaman;
use App\Models\Tool;
use App\Models\TransaksiPeminjamanTool;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanAktifToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:peminjamanAktifTools.index|peminjamanAktifTools.store|peminjamanAktifTools.returning|peminjamanAktifTools.update');
    }

    public function index() {
        $data_peminjaman_aktif = TransaksiPeminjamanTool::where('aktif', 1)->orderBy('updated_at', 'desc')->paginate(10);
        $data_user = User::all();
        $data_tools = Tool::all();

        return view('peminjamanAktifTool.index', ['data_peminjaman_aktif' => $data_peminjaman_aktif, 'data_user' => $data_user, 'data_tools' => $data_tools]);
    }

    public function store(PeminjamanAktifToolRequest $request) {
        $peminjaman_tools = TransaksiPeminjamanTool::create([
            'tanggal_waktu_pinjam' => $request->tanggal_waktu_pinjam,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'id_user' => $request->user,
            'aktif' => 1,
        ]);

        foreach($request->tools as $aset) {
            Tool::where('id_aset', $aset)->update([
                'status_saat_ini' => 'Keluar',
                'id_gudang' => null
            ]);

            ListToolsTransaksiPeminjaman::create([
                'id_peminjaman_tool' => $peminjaman_tools->id,
                'id_aset' => $aset,
            ]);
        }

        return redirect(route('peminjamanAktifTools.index'));
    }

    public function returning($id) {
        $peminjaman_aktif = TransaksiPeminjamanTool::find($id);
        $gudang = Gudang::all();

        return view('peminjamanAktifTool.returning', ['data_peminjaman_aktif' => $peminjaman_aktif, 'data_gudang' => $gudang]);
    }

    public function update($id, PeminjamanAktifToolRequest $request) {
        for($i = 0; $i < count($request->id_list_tools); $i++) {
            KondisiToolsTransaksiPeminjaman::create([
                'id_list_tools' => $request->id_list_tools[$i],
                'status_kondisi' => $request->status_kondisi[$i],
                'deskripsi' => $request->deskripsi[$i],
            ]);

            $list_tools = ListToolsTransaksiPeminjaman::find($request->id_list_tools[$i]);

            Tool::where('id_aset', $list_tools->id_aset)->update([
                'status_saat_ini' => 'Digudang',
                'id_gudang' => $request->gudang,
            ]);
        }

        TransaksiPeminjamanTool::where('id', $id)->update([
            'aktif' => 0,
            'tanggal_waktu_kembali' => Carbon::now('Asia/Jakarta'),
        ]);

        return redirect(route('peminjamanAktifTools.index'));
    }
}
