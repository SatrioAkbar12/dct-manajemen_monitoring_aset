<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanAktifRequest;
use App\Models\Kendaraan;
use App\Models\KondisiKendaraanTransaksasiPeminjaman;
use App\Models\TransaksiPeminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanAktifController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:peminjamanAktif.index|peminjamanAktif.store|peminjamanAktif.returning|peminjamanAktif.update');
    }

    public function index() {
        $peminjaman_aktif = TransaksiPeminjaman::where('aktif', 1)->paginate(10);
        $user = User::all();
        $kendaraan = Kendaraan::all();

        return view('peminjamanAktif.index', ['data_peminjaman_aktif' => $peminjaman_aktif, 'data_user' => $user, 'data_kendaraan' => $kendaraan]);
    }

    public function store(PeminjamanAktifRequest $request) {
        $peminjaman_aktif = TransaksiPeminjaman::where('id_kendaraan', $request->kendaraan)->where(function($query) use ($request) {
            $query->where('aktif', 1)->orWhere(function($query) use ($request) {
                $query->where('tanggal_waktu_pinjam', '<=', $request->tanggal_waktu_pinjam)->where('target_tanggal_waktu_kembali', '>=', $request->tanggal_waktu_pinjam);
            });
        })->first();

        if($peminjaman_aktif != null) {
            Alert::error('Gagal menyimpan!', 'Kendaraan ' . $peminjaman_aktif->kendaraan->nopol . " - " . $peminjaman_aktif->kendaraan->jenisKendaraan->nama . " " . $peminjaman_aktif->kendaraan->merk . " " . $peminjaman_aktif->kendaraan->tipe . " " . $peminjaman_aktif->kendaraan->warna . " sedang digunakan!");

            return redirect()->back();
        }

        TransaksiPeminjaman::create([
            'id_user' => $request->user,
            'id_kendaraan' => $request->kendaraan,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'aktif' => 1,
            'tanggal_waktu_pinjam' => $request->tanggal_waktu_pinjam,
        ]);

        return redirect(route('peminjamanAktif.index'));
    }

    public function returning($id) {
        $peminjaman_aktif = TransaksiPeminjaman::find($id);

        return view('peminjamanAktif.returning', ['data_peminjaman_aktif' => $peminjaman_aktif]);
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
            'aktif' => 0,
            'tanggal_waktu_kembali' => Carbon::now('Asia/Jakarta'),
        ]);

        $kendaraan->update([
            'km_saat_ini' => $request->km_terakhir,
        ]);

        return redirect(route('peminjamanAktif.index'));
    }
}
