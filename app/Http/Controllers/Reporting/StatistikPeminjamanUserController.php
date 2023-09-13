<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPeminjamanKendaraan;
use App\Models\TransaksiPeminjamanTool;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatistikPeminjamanUserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:reporting.statistikPeminjamanUser.index|reporting.statistikPeminjamanUser.kendaraan|reporting.statistikPeminjamanUser.tools');
    }

    public function index()
    {
        $data_user = User::paginate(20);

        return view('reporting.statistikPerminjamanUser.index', ['data_user' => $data_user]);
    }

    public function kendaraan($id_user)
    {
        $data_user = User::with('statistikPeminjamanKendaraanUser')->find($id_user);
        $jumlah_peminjaman_bulan_ini = TransaksiPeminjamanKendaraan::where('id_user', $id_user)->whereMonth('created_at', Carbon::now()->month)->count();
        $jumlah_peminjaman_aktif = TransaksiPeminjamanKendaraan::where('id_user', $id_user)->where('aktif', 1)->count();

        return view('reporting.statistikPerminjamanUser.kendaraan', ['data_user' => $data_user, 'jumlah_peminjaman_bulan_ini' => $jumlah_peminjaman_bulan_ini, 'jumlah_peminjaman_aktif' => $jumlah_peminjaman_aktif]);
    }

    public function tools($id_user)
    {
        $data_user = User::with('statistikPeminjamanToolsUser')->find($id_user);
        $jumlah_peminjaman_bulan_ini = TransaksiPeminjamanTool::where('id_user', $id_user)->whereMonth('created_at', Carbon::now()->month)->count();
        $jumlah_peminjaman_aktif = TransaksiPeminjamanTool::where('id_user', $id_user)->where('aktif', 1)->count();

        return view('reporting.statistikPerminjamanUser.tools', ['data_user' => $data_user, 'jumlah_peminjaman_bulan_ini' => $jumlah_peminjaman_bulan_ini, 'jumlah_peminjaman_aktif' => $jumlah_peminjaman_aktif]);
    }
}
