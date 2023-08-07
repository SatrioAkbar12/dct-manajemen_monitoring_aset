<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $data = User::paginate(10);

        return view('user.index', ['data' => $data]);
    }

    public function store(UserRequest $request) {
        User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'memiliki_sim' => $request->memiliki_sim
        ]);

        return redirect('/user');
    }

    public function show($id) {
        $data = User::find($id);

        return view('user.update', ['data' => $data]);
    }

    public function update($id, UserRequest $request) {
        User::where('id', $id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'memiliki_sim' => $request->memiliki_sim
        ]);

        return redirect('/user');
    }

    public function del($id) {
        User::where('id', $id)->delete();

        return redirect('/user');
    }
}
