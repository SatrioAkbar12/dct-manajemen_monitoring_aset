<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user.index|user.store|user.show|user.update|user.updateRole|user.del');
    }

    public function index() {
        $data = User::orderBy('updated_at', 'desc')->paginate(10);
        $data_role = Role::all();

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('user.index', ['data' => $data, 'data_role' => $data_role]);
    }

    public function store(UserRequest $request) {
        $faker = Faker::create();
        $password = $faker->password(20,20);

        $user = User::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($password),
            'memiliki_sim' => $request->memiliki_sim,
            'first_login' => 1,
        ]);

        $user->assignRole($request->role);

        Alert::success('Tersimpan!', 'Berhasil menambahkan data user');

        return view('user.create', ['data_user' => $user,'generate_password' => $password]);
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

        Alert::success('Tersimpan!', 'Berhasil mengubah data user');

        return redirect(route('user.index'));
    }

    public function updateRole($id, UserRequest $request) {
        $user = User::find($id);
        if($request->former_role != null) {
            $user->removeRole($request->former_role);
        }
        $user->assignRole($request->role);

        Alert::success('Tersimpan!', 'Berhasil mengubah role user');

        return redirect(route('user.index'));
    }

    public function del($id) {
        User::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus user');

        return redirect(route('user.index'));
    }
}
