<?php

namespace App\Http\Controllers\TransaksiPeminjamanKendaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiPeminjamanKendaraan\PeminjamanBaruKendaraanRequest;
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

class PeminjamanBaruKendaraanController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:peminjamanBaruKendaraan.index|peminjamanBaruKendaraan.create|peminjamanBaruKendaraan.store|peminjamanBaruKendaraan.review|peminjamanBaruKendaraan.approval|peminjamanBaruKendaraan.del');
    }

    public function index()
    {
        $peminjaman = TransaksiPeminjamanKendaraan::where('aktif', null)->where('approval_pengembalian', null)->orderBy('created_at', 'asc');
        $user = User::all();
        $kendaraan = Kendaraan::all();
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin')) ) {
            $peminjaman = $peminjaman->where('id_user', $auth_user->id);
        }

        $peminjaman = $peminjaman->paginate(20);

        $title = 'Hapus peminjaman';
        $text = 'Apakah anda yakin menghapus peminjaman ini?';
        confirmDelete($title, $text);

        return view('transaksiPeminjamanKendaraan.peminjamanBaru.index', ['data_peminjaman' => $peminjaman, 'data_kendaraan' => $kendaraan, 'data_user' => $user]);
    }

    public function create(PeminjamanBaruKendaraanRequest $request)
    {
        $peminjaman_aktif = TransaksiPeminjamanKendaraan::where('id_kendaraan', $request->kendaraan)->where(function($query) use ($request) {
            $query->where('aktif', 1)->where(function($query) use ($request) {
                $query->where('tanggal_waktu_pinjam', '<=', $request->tanggal_waktu_pinjam)->Where('target_tanggal_waktu_kembali', '>=', $request->tanggal_waktu_pinjam);
            });
        })->first();

        if($peminjaman_aktif != null) {
            Alert::error('Gagal menyimpan!', 'Kendaraan ' . $peminjaman_aktif->kendaraan->aset->kode_aset . " - ". $peminjaman_aktif->kendaraan->nopol . " - " . $peminjaman_aktif->kendaraan->jenisKendaraan->nama . " " . $peminjaman_aktif->kendaraan->merk . " " . $peminjaman_aktif->kendaraan->tipe . " " . $peminjaman_aktif->kendaraan->warna . " sedang digunakan!");

            return redirect()->back();
        }

        $user = User::find($request->user)->nama;
        $kendaraan = Kendaraan::where('id', $request->kendaraan)->first();

        return view('transaksiPeminjamanKendaraan.peminjamanBaru.create', ['data_peminjaman' => $request->all(), 'kendaraan' => $kendaraan, 'user' => $user]);
    }

    public function store(PeminjamanBaruKendaraanRequest $request)
    {
        $transaksi = TransaksiPeminjamanKendaraan::create([
            'id_user' => $request->user,
            'id_kendaraan' => $request->kendaraan,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'tanggal_waktu_pinjam' => $request->tanggal_waktu_pinjam,
            'keperluan' => $request->keperluan,
            'lokasi_tujuan' => $request->lokasi_tujuan,
            'geolocation_pinjam' => $request->geo_latitude . ',' . $request->geo_longitude,
        ]);

        $path_speedometer = $request->file('foto_speedometer')->storeAs('foto-speedometer', time() . "_speedometer-sebelum." . $request->file('foto_speedometer')->getClientOriginalExtension(), 'public');
        $path_depan_pinjam = $request->file('foto_depan_sebelum')->storeAs('foto-kondisi/kendaraan', time() . "_foto-depan-sebelum." . $request->file('foto_depan_sebelum')->getClientOriginalExtension(), 'public');
        $path_belakang_pinjam = $request->file('foto_belakang_sebelum')->storeAs('foto-kondisi/kendaraan', time() . "_foto-belakang-sebelum." . $request->file('foto_belakang_sebelum')->getClientOriginalExtension(), 'public');
        $path_kanan_pinjam = $request->file('foto_kanan_sebelum')->storeAs('foto-kondisi/kendaraan', time() . "_foto-kanan-sebelum." . $request->file('foto_kanan_sebelum')->getClientOriginalExtension(), 'public');
        $path_kiri_pinjam = $request->file('foto_kiri_sebelum')->storeAs('foto-kondisi/kendaraan', time() . "_foto-kiri-sebelum." . $request->file('foto_kiri_sebelum')->getClientOriginalExtension(), 'public');

        KondisiKendaraanTransaksasiPeminjaman::create([
            'id_transaksi' => $transaksi->id,
            'foto_speedometer_sebelum' => $path_speedometer,
            'foto_depan_pinjam' => $path_depan_pinjam,
            'foto_belakang_pinjam' => $path_belakang_pinjam,
            'foto_kanan_pinjam' => $path_kanan_pinjam,
            'foto_kiri_pinjam' => $path_kiri_pinjam,
        ]);

        Alert::success('Tersimpan!', 'Berhasil menyimpan peminjaman. Silahkan tunggu approval dari admin.');

        return redirect(route('peminjamanBaruKendaraan.index'));
    }

    public function review($id)
    {
        $peminjaman = TransaksiPeminjamanKendaraan::with(['user', 'kendaraan', 'kondisiKendaraan'])->find($id);

        return view('transaksiPeminjamanKendaraan.peminjamanBaru.review', ['data_peminjaman' => $peminjaman]);
    }

    public function approval($id, PeminjamanBaruKendaraanRequest $request)
    {
        $peminjaman = TransaksiPeminjamanKendaraan::find($id);

        $peminjaman->approval_peminjaman = $request->approved;
        $peminjaman->keterangan_approval_peminjaman = $request->keterangan;
        if($request->approved == 1) {
            $peminjaman->aktif = 1;
            $peminjaman->approval_pengembalian = 0;

            $kendaraan = Kendaraan::find($peminjaman->id_kendaraan);
            Artisan::call('reporting:statistik-penggunaan-aset', [
                '--user' => $request->user,
                '--aset' => $kendaraan->id_aset,
            ]);

            $telegram = TelegramData::where('tipe', 'group')->first();
            Notification::send($telegram->id_telegram, (new PeminjamanAktifKendaraanNotification($peminjaman))->delay(Carbon::parse($peminjaman->target_tanggal_waktu_kembali)));
        }
        $peminjaman->save();


        Alert::success('Tersimpan!', 'Approval peminjaman kendaraan berhasil tersimpan');

        return redirect(route('peminjamanBaruKendaraan.index'));
    }

    public function del($id)
    {
        TransaksiPeminjamanKendaraan::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus peminjaman kendaraan');

        return redirect(route('peminjamanBaruKendaraan.index'));
    }
}
