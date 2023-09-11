<?php

namespace App\Http\Controllers;

use App\Http\Requests\TelegramDataRequest;
use App\Models\TelegramData;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TelegramDataController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:telegramData.index|telegramData.update');
    }

    public function index() {
        $data_telegram = TelegramData::all();

        return view('telegramData.index', ['data_telegram' => $data_telegram]);
    }

    public function update($id, TelegramDataRequest $request) {
        if( $request->id_telegram == null && $request->username == null) {
            Alert::error('Gagal menyimpan!', 'Harap minimal isi salah satu input form');

            return redirect(route('telegramData.index'));
        }

        TelegramData::where('id', $id)->update([
            'id_telegram' => $request->id_telegram,
            'username' => $request->username
        ]);

        Alert::success('Tersimpan!', 'Berhasil memperbarui data telegram');

        return redirect(route('telegramData.index'));
    }
}
