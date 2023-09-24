<?php

namespace App\Http\Controllers\TransaksiPeminjamanKendaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiPeminjamanKendaraan\ApprovalPengembalianKendaraanRequest;
use App\Models\Kendaraan;
use App\Models\ServisRutinKendaraan;
use App\Models\TelegramData;
use App\Models\TransaksiPeminjamanKendaraan;
use App\Notifications\KmTargetPassedServisRutinKendaraanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalPengembalianKendaraanController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:approvalPengembalianKendaraan.index|approvalPengembalianKendaraan.review|approvalPengembalianKendaraan.approval');
    }

    public function index() {
        $data_peminjaman = TransaksiPeminjamanKendaraan::where('aktif', 0)->where('approval_pengembalian', 0)->orderBy('updated_at', 'asc');
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin')) ) {
            $data_peminjaman = $data_peminjaman->where('id_user', $auth_user->id);
        }

        $data_peminjaman = $data_peminjaman->paginate(10);

        return view('transaksiPeminjamanKendaraan.approvalPengembalianKendaraan.index', ['data_peminjaman' => $data_peminjaman]);
    }

    public function review($id) {
        $data_peminjaman = TransaksiPeminjamanKendaraan::find($id);

        return view('transaksiPeminjamanKendaraan.approvalPengembalianKendaraan.review', ['data_peminjaman' => $data_peminjaman]);
    }

    public function approval($id, ApprovalPengembalianKendaraanRequest $request) {
        $data_peminjaman = TransaksiPeminjamanKendaraan::find($id);

        if($request->approved == 1) {
            $data_peminjaman->update([
                'approval_pengembalian' => 1,
            ]);

            $kendaraan = Kendaraan::find($data_peminjaman->id_kendaraan);
            $servis = ServisRutinKendaraan::where('id_kendaraan', $data_peminjaman->id_kendaraan)->orderBy('created_at', 'desc')->first();
            if($data_peminjaman->kondisiKendaraan->km_terakhir >= $servis->km_target) {
                $kendaraan->update([
                    'km_saat_ini' => $data_peminjaman->kondisiKendaraan->km_terakhir,
                    'perlu_servis' => 1,
                ]);

                $telegram = TelegramData::where('tipe', 'channel')->first();
                if($telegram->id_telegram != null) {
                    Notification::sendNow($telegram->id_telegram, new KmTargetPassedServisRutinKendaraanNotification($servis));
                }
                else {
                    Notification::sendNow($telegram->username, new KmTargetPassedServisRutinKendaraanNotification($servis));
                }
            }
            else {
                $kendaraan->update([
                    'km_saat_ini' => $data_peminjaman->kondisiKendaraan->km_terakhir,
                ]);
            }
        }
        else {
            $data_peminjaman->update([
                'aktif' => 1,
                'keterangan_approval_pengembalian' => $request->keterangan,
            ]);
        }

        Alert::success('Tersimpan!', 'Hasil approval berhasil tersimpan');

        return redirect(route('approvalPengembalianKendaraan.index'));
    }
}
