<?php

namespace App\Http\Controllers\TransaksiPeminjamanTool;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiPeminjamanTool\ApprovalPengembalianToolRequest;
use App\Models\Tool;
use App\Models\TransaksiPeminjamanTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalPengembalianToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:approvalPengembalianTools.index|approvalPengembalianTools.review|approvalPengembalianTools.approval');
    }

    public function index() {
        $data_peminjaman = TransaksiPeminjamanTool::where('aktif', 0)->where('approval_pengembalian', 0)->orderBy('updated_at', 'asc');
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin')) ) {
            $data_peminjaman = $data_peminjaman->where('id_user', $auth_user->id);
        }

        $data_peminjaman = $data_peminjaman->paginate(10);

        return view('transaksiPeminjamanTool.approvalPengembalianTool.index', ['data_peminjaman' => $data_peminjaman]);
    }

    public function review($id) {
        $data_peminjaman = TransaksiPeminjamanTool::find($id);

        return view('transaksiPeminjamanTool.approvalPengembalianTool.review', ['data_peminjaman' => $data_peminjaman]);
    }

    public function approval($id, ApprovalPengembalianToolRequest $request) {
        $data_peminjaman = TransaksiPeminjamanTool::find($id);

        if($request->approved == 1) {
            $data_peminjaman->update([
                'approval_pengembalian' => 1,
            ]);

            foreach($data_peminjaman->listTools as $list_tools) {
                Tool::where('id_aset', $list_tools->id_aset)->update([
                    'status_saat_ini' => 'Di gudang',
                    'id_gudang' => $data_peminjaman->id_gudang_kembali,
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

        return redirect(route('approvalPengembalianTools.index'));
    }
}
