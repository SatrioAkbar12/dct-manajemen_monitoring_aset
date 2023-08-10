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
    public function __construct()
    {
        $this->middleware('permission:peminjamanAktif.index|peminjamanAktif.store|peminjamanAktif.returning|peminjamanAktif.update');
    }

    public function index() {
        $peminjam_aktif = TransaksiPeminjaman::where('aktif', 1)->paginate(10);
        $user = User::all();
        $kendaraan = Kendaraan::all();

        return view('peminjamanAktif.index', ['data_peminjaman_aktif' => $peminjam_aktif, 'data_user' => $user, 'data_kendaraan' => $kendaraan]);
    }

    public function store(PeminjamanAktifRequest $request) {
        // $peminjaman_aktif = TransaksiPeminjaman::where('id_kendaraan', $request->kendaraan)->where(function($query) use ($request) {
        //     $query->where('tanggal_pinjam', '<=', $request->tanggal_pinjam)->where('target_tanggal_waktu_kembali', '>=', $request->tanggal_pinjam);
        // })->first();

        TransaksiPeminjaman::create([
            'id_user' => $request->user,
            'id_kendaraan' => $request->kendaraan,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'aktif' => 1,
            'tanggal_pinjam' => $request->tanggal_pinjam,
        ]);

        return redirect(route('peminjamanAktif.index'));
    }

    public function returning($id) {
        $peminjam_aktif = TransaksiPeminjaman::find($id);

        return view('peminjamanAktif.returning', ['data_peminjaman_aktif' => $peminjam_aktif]);
    }

    public function update($id, PeminjamanAktifRequest $request) {
        $path_depan = $request->file('foto_depan')->storeAs('foto-kondisi', time() . "_foto-depan." . $request->file('foto_depan')->getClientOriginalExtension(), 'public');
        $path_belakang = $request->file('foto_belakang')->storeAs('foto-kondisi', time() . "_foto-belakang." . $request->file('foto_belakang')->getClientOriginalExtension(), 'public');
        $path_kanan = $request->file('foto_kanan')->storeAs('foto-kondisi', time() . "_foto_kanan" . $request->file('foto_kanan')->getClientOriginalExtension(), 'public');
        $path_kiri = $request->file('foto_kiri')->storeAs('foto-kondisi', time() . "_foto_kiri" . $request->file('foto_kiri')->getClientOriginalExtension(), 'public');

        $transaksi = TransaksiPeminjaman::find($id);
        $kendaraan = Kendaraan::find($transaksi->id_kendaraan);

        KondisiKendaraanTransaksasiPeminjaman::create([
            'id_transaksi' => $id,
            'status_kondisi' => $request->status_kondisi,
            'deskripsi' => $request->deskripsi,
            'km_terakhir' => $request->km_terakhir,
            'jumlah_km' => $request->km_terakhir - $kendaraan->km_saat_ini,
            'foto_depan' => $path_depan,
            'foto_belakang' => $path_belakang,
            'foto_kanan' => $path_kanan,
            'foto_kiri' => $path_kiri,
        ]);

        $transaksi->update([
            'aktif' => 0
        ]);

        $kendaraan->update([
            'km_saat_ini' => $request->km_terakhir,
        ]);

        return redirect(route('peminjamanAktif.index'));
    }
}
