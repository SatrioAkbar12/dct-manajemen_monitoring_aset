<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanAktifToolRequest;
use App\Models\Gudang;
use App\Models\KondisiToolsTransaksiPeminjaman;
use App\Models\ListToolsTransaksiPeminjaman;
use App\Models\Tool;
use App\Models\TransaksiPeminjamanTool;
use App\Models\User;
use App\Notifications\PeminjamanAktifToolNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanAktifToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:peminjamanAktifTools.index|peminjamanAktifTools.create|peminjamanAktifTools.store|peminjamanAktifTools.returning|peminjamanAktifTools.update');
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

    public function create(PeminjamanAktifToolRequest $request) {
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

        $user = User::find($request->user)->nama;
        $tools = Tool::with('aset')->whereIn('id_aset', $request->tools)->get();

        return view('peminjamanAktifTool.create', ['data_peminjaman_aktif' => $request->all(), 'user' => $user, 'tools' => $tools]);
    }

    public function store(PeminjamanAktifToolRequest $request) {
        $peminjaman_tools = TransaksiPeminjamanTool::create([
            'tanggal_waktu_pinjam' => $request->tanggal_waktu_pinjam,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'id_user' => $request->user,
            'aktif' => 1,
            'keperluan' => $request->keperluan,
            'lokasi_tujuan' => $request->lokasi_tujuan,
            'geolocation_pinjam' => $request->geo_latitude . ',' . $request->geo_longitude,
        ]);

        foreach($request->file('foto_tool') as $key => $foto_tool) {
            $tool = Tool::with('aset')->where('id_aset', $request->tools[$key])->first();

            $tool->update([
                'status_saat_ini' => 'Keluar',
                'id_gudang' => null
            ]);

            $list_tools = ListToolsTransaksiPeminjaman::create([
                'id_peminjaman_tool' => $peminjaman_tools->id,
                'id_aset' => $request->tools[$key],
            ]);

            $path_foto = $foto_tool->storeAs('foto-kondisi/tools', time() . '_' . $tool->aset->kode_aset . '_tools-sebelum.' . $foto_tool->getClientOriginalExtension(), 'public');

            KondisiToolsTransaksiPeminjaman::create([
                'id_list_tools' => $list_tools->id,
                'foto_sebelum' => $path_foto,
            ]);
        }

        Notification::send('-941911320', (new PeminjamanAktifToolNotification($peminjaman_tools))->delay(Carbon::parse($peminjaman_tools->target_tanggal_waktu_kembali)));

        Alert::success('Tersimpan!', 'Berhasil menambahkan peminjaman aktif tools');

        return redirect(route('peminjamanAktifTools.index'));
    }

    public function returning($id) {
        $peminjaman_aktif = TransaksiPeminjamanTool::find($id);
        $gudang = Gudang::all();

        return view('peminjamanAktifTool.returning', ['data_peminjaman_aktif' => $peminjaman_aktif, 'data_gudang' => $gudang]);
    }

    public function update($id, PeminjamanAktifToolRequest $request) {
        foreach($request->file('foto_tool') as $key => $foto_tool) {
            $list_tools = ListToolsTransaksiPeminjaman::find($request->id_list_tools[$key]);
            $tool = Tool::where('id_aset', $list_tools->id_aset)->first();

            $path_foto = $foto_tool->storeAs('foto-kondisi/tools', time() . '_' . $tool->aset->kode_aset . '_tools-sesudah.' . $foto_tool->getClientOriginalExtension(), 'public');

            KondisiToolsTransaksiPeminjaman::where('id_list_tools', $request->id_list_tools[$key])->update([
                'id_list_tools' => $request->id_list_tools[$key],
                'status_kondisi' => $request->status_kondisi[$key],
                'deskripsi' => $request->deskripsi[$key],
                'foto_sesudah' => $path_foto,
            ]);
        }

        TransaksiPeminjamanTool::where('id', $id)->update([
            'aktif' => 0,
            'tanggal_waktu_kembali' => Carbon::now('Asia/Jakarta'),
            'id_gudang_kembali' => $request->gudang,
            'geolocation_kembali' => $request->geo_latitude . ',' . $request->geo_longitude,
        ]);

        Alert::success('Tersimpan!', 'Berhasil menyelesaikan peminjaman tools');

        return redirect(route('peminjamanAktifTools.index'));
    }
}
