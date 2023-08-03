<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPeminjaman;
use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    public function index() {
        $riwayat_peminjaman = TransaksiPeminjaman::where('aktif', 0)->paginate(10);

        return view('riwayatPeminjaman.index', ['data_riwayat_peminjaman' => $riwayat_peminjaman]);
    }
}
