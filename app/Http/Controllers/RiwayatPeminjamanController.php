<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPeminjaman;
use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:riwayatPeminjaman.index|riwayatPeminjaman.detail');
    }

    public function index() {
        $riwayat_peminjaman = TransaksiPeminjaman::where('aktif', 0)->paginate(10);

        return view('riwayatPeminjaman.index', ['data_riwayat_peminjaman' => $riwayat_peminjaman]);
    }

    public function detail($id) {
        $riwayat_peminjaman = TransaksiPeminjaman::find($id);

        return view('riwayatPeminjaman.detail', ['data_riwayat_peminjaman' => $riwayat_peminjaman]);
    }
}
