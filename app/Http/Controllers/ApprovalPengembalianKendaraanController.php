<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalPengembalianKendaraanRequest;
use App\Models\TransaksiPeminjamanKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovalPengembalianKendaraanController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:approvalPengembalianKendaraan.index|approvalPengembalianKendaraan.review|approvalPengembalianKendaraan.approval');
    }

    public function index() {
        $data_peminjaman = TransaksiPeminjamanKendaraan::where('aktif', 0)->where('approved', 0)->orderBy('updated_at', 'desc');
        $auth_user = Auth::user();

        if( !($auth_user->hasRole('admin')) ) {
            $data_peminjaman = $data_peminjaman->where('id_user', $auth_user->id);
        }

        $data_peminjaman = $data_peminjaman->paginate(10);

        return view('approvalPengembalianKendaraan.index', ['data_peminjaman' => $data_peminjaman]);
    }

    public function review($id) {
        $data_peminjaman = TransaksiPeminjamanKendaraan::find($id);

        return view('approvalPengembalianKendaraan.review', ['data_peminjaman' => $data_peminjaman]);
    }

    public function approval($id, ApprovalPengembalianKendaraanRequest $request) {
        $data_peminjaman = TransaksiPeminjamanKendaraan::find($id);

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

        return redirect(route('approvalPengembalianKendaraan.index'));
    }
}
