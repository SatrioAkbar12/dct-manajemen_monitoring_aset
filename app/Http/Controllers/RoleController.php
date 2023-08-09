<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.index|roles.store|roles.update|roles.del');
    }

    public function index() {
        $data = Role::paginate(10);

        return view('role.index', ['data' => $data]);
    }

    public function store(RoleRequest $request) {
        Role::create([
            'name' => $request->nama
        ]);

        return redirect(route('roles.index'));
    }

    public function update($id, RoleRequest $request) {
        Role::where('id', $id)->update([
            'name' => $request->nama
        ]);

        return redirect(route('roles.index'));
    }

    public function del($id) {
        Role::where('id', $id)->delete();

        return redirect(route('roles.index'));
    }
}
