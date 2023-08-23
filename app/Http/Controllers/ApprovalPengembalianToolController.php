<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalPengembalianToolRequest;
use App\Models\TransaksiPeminjamanTool;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalPengembalianToolController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:approvalPengembalianTools.index|approvalPengembalianTools.review|approvalPengembalianTools.approval');
    }

    public function index() {
        $data_peminjaman = TransaksiPeminjamanTool::where('aktif', 0)->where('approved', 0)->paginate(10);

        return view('approvalPengembalianTool.index', ['data_peminjaman' => $data_peminjaman]);
    }

    public function review($id) {
        $data_peminjaman = TransaksiPeminjamanTool::find($id);

        return view('approvalPengembalianTool.review', ['data_peminjaman' => $data_peminjaman]);
    }

    public function approval($id, ApprovalPengembalianToolRequest $request) {
        $data_peminjaman = TransaksiPeminjamanTool::find($id);

        if($request->approved == 1) {
            $data_peminjaman->update([
                'approved' => 1,
            ]);
        }
        else {
            $data_peminjaman->update([
                'aktif' => 1,
                'keterangan_approved' => $request->keterangan,
            ]);
        }

        Alert::success('Tersimpan!', 'Hasil approval berhasil tersimpan');

        return redirect(route('approvalPengembalianTools.index'));
    }
}
