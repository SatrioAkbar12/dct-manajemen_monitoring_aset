<?php

namespace App\Http\Controllers\TransaksiPeminjamanTool;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiPeminjamanTool\PeminjamanAktifToolRequest;
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

        return view('transaksiPeminjamanTool.peminjamanAktifTool.index', ['data_peminjaman_aktif' => $data_peminjaman_aktif, 'data_user' => $data_user, 'data_tools' => $data_tools]);
    }

    public function returning($id) {
        $peminjaman_aktif = TransaksiPeminjamanTool::find($id);
        $gudang = Gudang::all();

        return view('transaksiPeminjamanTool.peminjamanAktifTool.returning', ['data_peminjaman_aktif' => $peminjaman_aktif, 'data_gudang' => $gudang]);
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
