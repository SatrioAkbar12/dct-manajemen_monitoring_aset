<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\TransaksiPeminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanAktifController extends Controller
{
    public function index() {
        $peminjam_aktif = TransaksiPeminjaman::where('aktif', 1)->paginate(10);
        $user = User::all();
        $kendaraan = Kendaraan::all();

        return view('peminjamanAktif.index', ['data_peminjaman_aktif' => $peminjam_aktif, 'data_user' => $user, 'data_kendaraan' => $kendaraan]);
    }

    public function store(Request $request) {
        TransaksiPeminjaman::create([
            'id_user' => $request->user,
            'id_kendaraan' => $request->kendaraan,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'aktif' => 1,
        ]);

        return redirect('/peminjaman-aktif');
    }

    public function returning($id) {
        $peminjam_aktif = TransaksiPeminjaman::find($id);

        return view('peminjamanAktif.returning', ['data_peminjaman_aktif' => $peminjam_aktif]);
    }
}
