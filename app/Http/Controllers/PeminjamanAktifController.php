<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanAktifKendaraanRequest;
use App\Models\Kendaraan;
use App\Models\KondisiKendaraanTransaksasiPeminjaman;
use App\Models\TelegramData;
use App\Models\TransaksiPeminjamanKendaraan;
use App\Models\User;
use App\Notifications\PeminjamanAktifKendaraanNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanAktifController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:peminjamanAktifKendaraan.index|peminjamanAktifKendaraan.store|peminjamanAktifKendaraan.returning|peminjamanAktifKendaraan.update');
    }

    public function index() {
        $peminjaman_aktif = TransaksiPeminjamanKendaraan::where('aktif', 1)->orderBy('target_tanggal_waktu_kembali', 'asc');
        $user = User::all();
        $kendaraan = Kendaraan::all();
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin')) ) {
            $peminjaman_aktif = $peminjaman_aktif->where('id_user', $auth_user->id);
        }

        $peminjaman_aktif = $peminjaman_aktif->paginate(10);

        return view('peminjamanAktifKendaraan.index', ['data_peminjaman_aktif' => $peminjaman_aktif, 'data_user' => $user, 'data_kendaraan' => $kendaraan]);
    }

    public function returning($id) {
        $peminjaman_aktif = TransaksiPeminjamanKendaraan::find($id);

        return view('peminjamanAktifKendaraan.returning', ['data_peminjaman_aktif' => $peminjaman_aktif]);
    }

    public function update($id, PeminjamanAktifKendaraanRequest $request) {
        $path_depan = $request->file('foto_depan')->storeAs('foto-kondisi/kendaraan', time() . "_foto-depan-sesudah." . $request->file('foto_depan')->getClientOriginalExtension(), 'public');
        $path_belakang = $request->file('foto_belakang')->storeAs('foto-kondisi/kendaraan', time() . "_foto-belakang-sesudah." . $request->file('foto_belakang')->getClientOriginalExtension(), 'public');
        $path_kanan = $request->file('foto_kanan')->storeAs('foto-kondisi/kendaraan', time() . "_foto-kanan-sesudah." . $request->file('foto_kanan')->getClientOriginalExtension(), 'public');
        $path_kiri = $request->file('foto_kiri')->storeAs('foto-kondisi/kendaraan', time() . "_foto-kiri-sesudah." . $request->file('foto_kiri')->getClientOriginalExtension(), 'public');
        $path_speedometer = $request->file('foto_speedometer')->storeAs('foto-speedometer', time() . "_speedometer-sesudah." . $request->file('foto_speedometer')->getClientOriginalExtension(), 'public');

        $transaksi = TransaksiPeminjamanKendaraan::find($id);
        $kendaraan = Kendaraan::find($transaksi->id_kendaraan);

        KondisiKendaraanTransaksasiPeminjaman::where('id_transaksi', $id)->update([
            'status_kondisi' => $request->status_kondisi,
            'deskripsi' => $request->deskripsi,
            'km_terakhir' => $request->km_terakhir,
            'jumlah_km' => $request->km_terakhir - $kendaraan->km_saat_ini,
            'foto_depan_kembali' => $path_depan,
            'foto_belakang_kembali' => $path_belakang,
            'foto_kanan_kembali' => $path_kanan,
            'foto_kiri_kembali' => $path_kiri,
            'foto_speedometer_sesudah' => $path_speedometer
        ]);

        $transaksi->update([
            'aktif' => 0,
            'tanggal_waktu_kembali' => Carbon::now('Asia/Jakarta'),
            'geolocation_kembali' => $request->geo_latitude . ',' . $request->geo_longitude,
        ]);

        Alert::success('Tersimpan!', 'Berhasil menyelesaikan peminjaman kendaraan');

        return redirect(route('peminjamanAktifKendaraan.index'));
    }
}
