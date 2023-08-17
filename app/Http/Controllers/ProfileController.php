<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index() {
        $data = Auth::user();

        return view('profil.index', ['data' => $data]);
    }

    public function update(ProfileRequest $request) {
        User::where('id', Auth::id())->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'memiliki_sim' => $request->memiliki_sim,
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah data profil');

        return redirect(route('profile.index'));
    }

    public function updatePassword(ProfileRequest $request) {
        User::where('id', Auth::id())->update([
            'password' => Hash::make($request->password_baru),
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah password anda');

        return redirect(route('profile.index'));
    }
}
