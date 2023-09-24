<?php

namespace App\Http\Controllers\TransaksiPeminjamanTool;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPeminjamanTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPeminjamanToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:riwayatPeminjamanTools.index|riwayatPeminjamanTools.detail');
    }

    public function index() {
        $data_riwayat_peminjaman = TransaksiPeminjamanTool::where('aktif', 0)->where('approval_pengembalian', 1)->orderBy('tanggal_waktu_kembali', 'desc');
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin')) ) {
            $data_riwayat_peminjaman = $data_riwayat_peminjaman->where('id_user', $auth_user->id);
        }

        $data_riwayat_peminjaman = $data_riwayat_peminjaman->paginate(10);

        return view('transaksiPeminjamanTool.riwayatPeminjamanTool.index', ['data_riwayat_peminjaman' => $data_riwayat_peminjaman]);
    }

    public function detail($id) {
        $data_riwayat_peminjaman = TransaksiPeminjamanTool::find($id);

        return view('transaksiPeminjamanTool.riwayatPeminjamanTool.detail', ['data_riwayat_peminjaman' => $data_riwayat_peminjaman]);
    }
}
