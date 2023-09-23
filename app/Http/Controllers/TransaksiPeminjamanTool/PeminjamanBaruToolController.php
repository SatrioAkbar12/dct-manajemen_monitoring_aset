<?php

namespace App\Http\Controllers\TransaksiPeminjamanTool;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiPeminjamanTool\PeminjamanBaruToolRequest;
use App\Models\KondisiToolsTransaksiPeminjaman;
use App\Models\ListToolsTransaksiPeminjaman;
use App\Models\TelegramData;
use App\Models\Tool;
use App\Models\TransaksiPeminjamanTool;
use App\Models\User;
use App\Notifications\PeminjamanAktifToolNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanBaruToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:peminjamanBaruTools.index|peminjamanBaruTools.create|peminjamanBaruTools.store|peminjamanBaruTools.review|peminjamanBaruTools.approval|peminjamanBaruTools.del');
    }

    public function index()
    {
        $peminjaman = TransaksiPeminjamanTool::with(['user', 'listTools', 'listTools.aset', 'listTools.aset.tool'])->where('aktif', null)->where('approval_pengembalian', null)->orderBy('created_at', 'asc');
        $user = User::all();
        $tools = Tool::all();
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin'))) {
            $peminjaman->where('id_user', $auth_user->id);
        }

        $peminjaman = $peminjaman->paginate(20);

        return view('transaksiPeminjamanTool.peminjamanBaru.index', ['data_peminjaman' => $peminjaman, 'data_tools' => $tools, 'data_user' => $user]);
    }

    public function create(PeminjamanBaruToolRequest $request)
    {
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

        return view('transaksiPeminjamanTool.peminjamanBaru.create', ['data_peminjaman' => $request->all(), 'tools' => $tools, 'user' => $user]);
    }

    public function store(PeminjamanBaruToolRequest $request)
    {
        $peminjaman_tools = TransaksiPeminjamanTool::create([
            'tanggal_waktu_pinjam' => $request->tanggal_waktu_pinjam,
            'target_tanggal_waktu_kembali' => $request->target_tanggal_waktu_kembali,
            'id_user' => $request->user,
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

        Alert::success('Tersimpan!', 'Berhasil menambahkan peminjaman aktif tools');

        return redirect(route('peminjamanBaruTools.index'));
    }

    public function review($id)
    {
        $peminjaman = TransaksiPeminjamanTool::with(['user', 'listTools', 'listTools.aset', 'listTools.aset.tool', 'listTools.kondisiToolsTransaksiPeminjaman'])->find($id);

        return view('transaksiPeminjamanTool.peminjamanBaru.review', ['data_peminjaman' => $peminjaman]);
    }

    public function approval($id, PeminjamanBaruToolRequest $request)
    {
        $peminjaman = TransaksiPeminjamanTool::with(['user', 'listTools', 'listTools.aset', 'listTools.aset.tool'])->find($id);

        $peminjaman->approval_peminjaman = $request->approved;
        $peminjaman->keterangan_approval_peminjaman = $request->keterangan;
        if($request->approved == 1) {
            $peminjaman->aktif = 1;
            $peminjaman->approval_pengembalian = 0;

            foreach($peminjaman->listTools as $list_tools) {
                Artisan::call('reporting:statistik-penggunaan-aset', [
                    '--user' => $request->user,
                    '--aset' => $list_tools->id_aset,
                ]);
            }

            $telegram = TelegramData::where('tipe', 'group')->first();
            Notification::send($telegram->id_telegram, (new PeminjamanAktifToolNotification($peminjaman))->delay(Carbon::parse($peminjaman->target_tanggal_waktu_kembali)));
        }
        $peminjaman->save();

        Alert::success('Tersimpan!', 'Approval peminjaman tools berhasil tersimpan');

        return redirect(route('peminjamanBaruTools.index'));
    }

    public function del($id)
    {
        TransaksiPeminjamanTool::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus peminjaman tools');

        return redirect(route('peminjamanBaruTools.index'));
    }
}
