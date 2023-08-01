<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $data = User::all();

        return view('user.index', ['data' => $data]);
    }

    public function store(Request $request) {
        // return $request->memiliki_sim

        User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'memiliki_sim' => $request->memiliki_sim == 'on' ? 1 : 0
        ]);

        return redirect('/user');
    }

    public function show($id) {
        $data = User::find($id);

        return view('user.update', ['data' => $data]);
    }

    public function update($id, Request $request) {
        User::where('id', $id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'memiliki_sim' => $request->memiliki_sim == 'on' ? 1 : 0
        ]);

        return redirect('/user');
    }

    public function del($id) {
        User::where('id', $id)->delete();

        return redirect('/user');
    }
}
