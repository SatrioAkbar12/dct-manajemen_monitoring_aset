<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:riwayatPeminjaman.index|riwayatPeminjaman.detail');
    }

    public function index() {
        $riwayat_peminjaman = TransaksiPeminjaman::where('aktif', 0);
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin')) ) {
            $riwayat_peminjaman = $riwayat_peminjaman->where('id_user', $auth_user->id);
        }

        $riwayat_peminjaman = $riwayat_peminjaman->paginate(10);

        return view('riwayatPeminjaman.index', ['data_riwayat_peminjaman' => $riwayat_peminjaman]);
    }

    public function detail($id) {
        $riwayat_peminjaman = TransaksiPeminjaman::find($id);

        return view('riwayatPeminjaman.detail', ['data_riwayat_peminjaman' => $riwayat_peminjaman]);
    }
}
