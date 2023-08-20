<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPeminjamanTool;
use Illuminate\Http\Request;

class RiwayatPeminjamanToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:riwayatPeminjamanTools.index|riwayatPeminjamanTools.detail');
    }

    public function index() {
        $data_riwayat_peminjaman = TransaksiPeminjamanTool::where('aktif', 0)->orderBy('tanggal_waktu_kembali', 'desc')->paginate(10);

        return view('riwayatPeminjamanTool.index', ['data_riwayat_peminjaman' => $data_riwayat_peminjaman]);
    }

    public function detail($id) {
        $data_riwayat_peminjaman = TransaksiPeminjamanTool::find($id);

        return view('riwayatPeminjamanTool.detail', ['data_riwayat_peminjaman' => $data_riwayat_peminjaman]);
    }
}
