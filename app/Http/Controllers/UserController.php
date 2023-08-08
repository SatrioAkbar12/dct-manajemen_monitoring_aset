<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $data = User::paginate(10);
        $data_role = Role::all();

        return view('user.index', ['data' => $data, 'data_role' => $data_role]);
    }

    public function store(UserRequest $request) {
        $user = User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'memiliki_sim' => $request->memiliki_sim
        ]);

        $user->assignRole($request->role);

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

    public function updateRole($id, UserRequest $request) {
        // return $request->former_role . " " . $request->role;

        $user = User::find($id);
        $user->removeRole($request->former_role);
        $user->assignRole($request->role);

        return redirect(route('user.index'));
    }

    public function del($id) {
        User::where('id', $id)->delete();

        return redirect('/user');
    }
}
