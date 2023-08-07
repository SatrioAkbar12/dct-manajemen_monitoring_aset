<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index() {
        $data_role = Role::paginate(20);

        return view('rolePermission.index', ['data_role' => $data_role]);
    }

    public function detail($id_role) {
        $data_role = Role::find($id_role);
        // dd($data_role);

        return view('rolePermission.detail', ['data_role' => $data_role]);
    }
}
