<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanAktifRequest;
use App\Models\Kendaraan;
use App\Models\KondisiKendaraanTransaksasiPeminjaman;
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

    public function store(PeminjamanAktifRequest $request) {
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

    public function update($id, PeminjamanAktifRequest $request) {
        $path = $request->file('foto_kondisi')->storeAs('foto-kondisi', time() . "_" . $request->file('foto_kondisi')->getClientOriginalName(), 'public');

        KondisiKendaraanTransaksasiPeminjaman::create([
            'id_transaksi' => $id,
            'status_kondisi' => $request->status_kondisi,
            'deskripsi' => $request->deskripsi,
            'foto' => $path
        ]);

        TransaksiPeminjaman::where('id', $id)->update([
            'aktif' => 0
        ]);

        return redirect('/peminjaman-aktif');
    }
}
