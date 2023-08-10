<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rolePermission.index|rolePermission.detail|rolePermission.store|rolePermission.del');
    }

    public function index() {
        $data_role = Role::paginate(20);

        return view('rolePermission.index', ['data_role' => $data_role]);
    }

    public function detail($id_role) {
        $data_role = Role::find($id_role);
        $data_permission = Permission::all();

        return view('rolePermission.detail', ['data_role' => $data_role, 'data_permission' => $data_permission]);
    }

    public function store($id_role, RolePermissionRequest $request) {
        $role = Role::find($id_role);;

        $role->givePermissionTo($request->permission);

        return redirect(route('rolePermission.detail', $id_role));
    }

    public function del($id_role, RolePermissionRequest $request) {
        $role = Role::find($id_role);

        $role->revokePermissionTo($request->permission);

        return redirect(route('rolePermission.detail', $id_role));
    }
}
