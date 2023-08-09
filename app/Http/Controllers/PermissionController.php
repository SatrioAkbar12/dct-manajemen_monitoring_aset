<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission.index|permission.permissionSync');
    }

    public function index() {
        $data = Permission::paginate(20);
        $jumlah_permission = Permission::count();

        return view('permission.index', ['data' => $data, 'jumlah_permission' => $jumlah_permission]);
    }

    public function permissionSync() {
        $route = Route::getRoutes();

        foreach($route as $route) {
            if($route->getName() != null) {
                Permission::updateOrCreate([
                    'name' => $route->getName(),
                ]);
            }
        }

        return redirect(route('permission.index'));
    }
}
