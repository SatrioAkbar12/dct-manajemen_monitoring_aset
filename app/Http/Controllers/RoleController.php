<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.index|roles.store|roles.update|roles.del');
    }

    public function index() {
        $data = Role::orderBy('updated_at', 'desc')->paginate(10);

        $title = 'Hapus data';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);

        return view('role.index', ['data' => $data]);
    }

    public function store(RoleRequest $request) {
        Role::create([
            'name' => $request->nama
        ]);

        Alert::success('Tersimpan!', 'Berhasil menambahkan role baru');

        return redirect(route('roles.index'));
    }

    public function update($id, RoleRequest $request) {
        Role::where('id', $id)->update([
            'name' => $request->nama
        ]);

        Alert::success('Tersimpan!', 'Berhasil mengubah data role');

        return redirect(route('roles.index'));
    }

    public function del($id) {
        Role::where('id', $id)->delete();

        Alert::success('Tersimpan!', 'Berhasil menghapus role');

        return redirect(route('roles.index'));
    }
}
