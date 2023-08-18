<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanAktifToolRequest;
use App\Models\ListToolsTransaksiPeminjaman;
use App\Models\Tool;
use App\Models\TransaksiPeminjamanTool;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanAktifToolController extends Controller
{
    public function __construct()
    {
        // return $this->middleware('permission:peminjamanAktifTools.index|peminjamanAktifTools.store|peminjamanAktifTools.returning|peminjamanAktifTools.update');
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

        return view('peminjamanAktifTool.returning', ['data_peminjaman_aktif' => $peminjaman_aktif]);
    }

    public function del() {

    }
}
