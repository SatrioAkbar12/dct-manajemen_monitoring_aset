<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $route = Route::getRoutes();

        foreach($route as $route) {
            if($route->getName() != null) {
                Permission::updateOrCreate([
                    'name' => $route->getName(),
                ]);
            }
        }
    }
}
