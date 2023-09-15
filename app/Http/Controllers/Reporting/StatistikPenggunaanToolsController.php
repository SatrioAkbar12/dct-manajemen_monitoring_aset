<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use App\Models\ListToolsTransaksiPeminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatistikPenggunaanToolsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:reporting.statistikPenggunaanTools.index|reporting.statistikPenggunaanTools.detail');
    }

    public function index()
    {
        $data_aset = Aset::with(['tool', 'listToolsTransaksiPeminjaman'])->where('tipe_aset', 'tool')->paginate(20);

        return view('reporting.statistikPenggunaanTools.index', ['data_aset' => $data_aset]);
    }

    public function detail($id)
    {
        $data_aset = Aset::with(['tool', 'listToolsTransaksiPeminjaman', 'statistikPenggunaanAset'])->where('id', $id)->first();
        $jumlah_penggunaan_bulan_ini = ListToolsTransaksiPeminjaman::where('id_aset', $id)->whereMonth('created_at', Carbon::now()->month)->count();

        return view('reporting.statistikPenggunaanTools.detail', ['data_aset' => $data_aset, 'jumlah_penggunaan_bulan_ini' => $jumlah_penggunaan_bulan_ini]);
    }
}
