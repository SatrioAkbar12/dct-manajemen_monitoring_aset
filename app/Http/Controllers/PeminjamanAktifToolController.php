<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanAktifToolRequest;
use App\Models\Gudang;
use App\Models\KondisiToolsTransaksiPeminjaman;
use App\Models\ListToolsTransaksiPeminjaman;
use App\Models\Tool;
use App\Models\TransaksiPeminjamanTool;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanAktifToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:peminjamanAktifTools.index|peminjamanAktifTools.store|peminjamanAktifTools.returning|peminjamanAktifTools.update');
    }

    public function index() {
        $data_peminjaman_aktif = TransaksiPeminjamanTool::where('aktif', 1)->orderBy('target_tanggal_waktu_kembali', 'asc');
        $data_user = User::all();
        $data_tools = Tool::all();
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin'))) {
            $data_peminjaman_aktif->where('id_user', $auth_user->id);
        }

        $data_peminjaman_aktif = $data_peminjaman_aktif->paginate(10);

        return view('peminjamanAktifTool.index', ['data_peminjaman_aktif' => $data_peminjaman_aktif, 'data_user' => $data_user, 'data_tools' => $data_tools]);
    }

    public function store(PeminjamanAktifToolRequest $request) {
        $error_message = 'Tools :<ul>';
        $cek_error = 0;
        foreach($request->tools as $tools) {
            $peminjaman_aktif = ListToolsTransaksiPeminjaman::select('transaksi_peminjaman_tool.*', 'list_tools_transaksi_peminjaman.id as listTools_id', 'list_tools_transaksi_peminjaman.id_aset', 'aset.kode_aset', 'tools.nama', 'tools.merk', 'tools.model')
                ->join('transaksi_peminjaman_tool', 'list_tools_transaksi_peminjaman.id_peminjaman_tool', '=', 'transaksi_peminjaman_tool.id')
                ->join('aset', 'aset.id', '=', 'list_tools_transaksi_peminjaman.id_aset')
                ->join('tools', 'tools.id_aset', '=', 'aset.id')
                ->where('list_tools_transaksi_peminjaman.id_aset', $tools)
                ->where('aktif', 1)
                ->where(function($query) use ($request) {
                    $query->where('tanggal_waktu_pinjam', '<=', $request->tanggal_waktu_pinjam)->where('target_tanggal_waktu_kembali', '>=', $request->tanggal_waktu_pinjam);
                })
                ->first();

            if($peminjaman_aktif != null) {
                $cek_error = 1;
                $error_message = $error_message . '<li>' . $peminjaman_aktif->kode_aset . ' - ' . $peminjaman_aktif->nama . ' ' . $peminjaman_aktif->merk . ' ' . $peminjaman_aktif->model . '</li>';
            }
        }

        if($cek_error) {
            $error_message = $error_message . '</ul>sedang digunakan!';
            Alert::html('Gagal menyimpan!', $error_message, 'error');

            return redirect()->back();
        }

        $peminjaman_tools = TransaksiPeminjamanTool::create([
            'tanggal_waktu_pinjam' => $request->tanggal_waktu_pinjam,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'id_user' => $request->user,
            'aktif' => 1,
        ]);

        foreach($request->tools as $aset) {
            Tool::where('id_aset', $aset)->update([
                'status_saat_ini' => 'Keluar',
                'id_gudang' => null
            ]);

            ListToolsTransaksiPeminjaman::create([
                'id_peminjaman_tool' => $peminjaman_tools->id,
                'id_aset' => $aset,
            ]);
        }

        return redirect(route('peminjamanAktifTools.index'));
    }

    public function returning($id) {
        $peminjaman_aktif = TransaksiPeminjamanTool::find($id);
        $gudang = Gudang::all();

        return view('peminjamanAktifTool.returning', ['data_peminjaman_aktif' => $peminjaman_aktif, 'data_gudang' => $gudang]);
    }

    public function update($id, PeminjamanAktifToolRequest $request) {
        for($i = 0; $i < count($request->id_list_tools); $i++) {
            KondisiToolsTransaksiPeminjaman::create([
                'id_list_tools' => $request->id_list_tools[$i],
                'status_kondisi' => $request->status_kondisi[$i],
                'deskripsi' => $request->deskripsi[$i],
            ]);

            $list_tools = ListToolsTransaksiPeminjaman::find($request->id_list_tools[$i]);

            Tool::where('id_aset', $list_tools->id_aset)->update([
                'status_saat_ini' => 'Di gudang',
                'id_gudang' => $request->gudang,
            ]);
        }

        TransaksiPeminjamanTool::where('id', $id)->update([
            'aktif' => 0,
            'tanggal_waktu_kembali' => Carbon::now('Asia/Jakarta'),
            'id_gudang_kembali' => $request->gudang,
        ]);

        Alert::success('Tersimpan!', 'Berhasil menyelesaikan peminjaman tools');

        return redirect(route('peminjamanAktifTools.index'));
    }
}
