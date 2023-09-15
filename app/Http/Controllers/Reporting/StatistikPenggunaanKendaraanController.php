<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\StatistikPenggunaanAset;
use App\Models\TransaksiPeminjamanKendaraan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatistikPenggunaanKendaraanController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:reporting.statistikPenggunaanKendaraan.index|reporting.statistikPenggunaanKendaraan.detail');
    }

    public function index()
    {
        $data_aset = Aset::with(['kendaraan', 'statistikPenggunaanAset'])->where('tipe_aset', 'like', '%kendaraan%')->paginate(20);

        return view('reporting.statistikPenggunaanKendaraan.index', ['data_aset' => $data_aset]);
    }

    public function detail($id)
    {
        $data_aset = Aset::with(['kendaraan', 'statistikPenggunaanAset'])->find($id);
        $jumlah_penggunaan_bulan_ini = TransaksiPeminjamanKendaraan::where('id_kendaraan', $data_aset->kendaraan->id)->whereMonth('created_at', Carbon::now()->month)->count();

        return view('reporting.statistikPenggunaanKendaraan.detail', ['data_aset' => $data_aset, 'jumlah_penggunaan_bulan_ini' => $jumlah_penggunaan_bulan_ini]);
    }
}
