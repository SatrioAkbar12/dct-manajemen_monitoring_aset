<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasaAktifDokumenRequest;
use App\Models\Kendaraan;
use App\Models\MasaAktifDokumenKendaraan;
use App\Models\TipeDokumenKendaraan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasaAktifDokumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:masaAktifDokumen.index|masaAktifDokumen.getKendaraan|masaAktifDokumen.store|masaAktifDokumen.update|masaAktifDokumen.del');
    }

    public function index() {
        $kendaraan = Kendaraan::orderByRaw('-tanggal_perbarui_dokumen DESC')->paginate(10);

        return view('masaAktif.index', ['data_kendaraan' => $kendaraan]);
    }

    public function getKendaraan($id_kendaraan) {
        $kendaraan = Kendaraan::find($id_kendaraan);
        $tipe_dokumen = TipeDokumenKendaraan::all();

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('masaAktif.show', ['data_kendaraan' => $kendaraan, 'data_tipe_dokumen' => $tipe_dokumen]);
    }

    public function store($id_kendaraan, MasaAktifDokumenRequest $request) {
        MasaAktifDokumenKendaraan::create([
            'id_kendaraan' => $id_kendaraan,
            'id_tipe_dokumen' => $request->tipe_dokumen,
            'tanggal_masa_berlaku' => $request->masa_aktif
        ]);

        Alert::success('Tersimpan!', 'Berhasil menambahkan dokumen kendaraan baru');

        return redirect(route('masaAktifDokumen.getKendaraan', $id_kendaraan));
    }

    public function update($id_kendaraan, $id, MasaAktifDokumenRequest $request) {
        MasaAktifDokumenKendaraan::where('id', $id)->update([
            'tanggal_masa_berlaku' => $request->masa_aktif
        ]);

        Kendaraan::where('id', $id_kendaraan)->update([
            'tanggal_perbarui_dokumen' => null,
        ]);

        Alert::success('Tersimpan!', 'Berhasil memperbaru masa aktif dokumen');

        return redirect(route('masaAktifDokumen.getKendaraan', $id_kendaraan));
    }

    public function del($id_kendaraan, $id) {
        MasaAktifDokumenKendaraan::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus dokumen kendaraan');

        return redirect(route('masaAktifDokumen.getKendaraan', $id_kendaraan));
    }
}
