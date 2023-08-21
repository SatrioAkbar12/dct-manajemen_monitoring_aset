<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();
        $permission = Permission::all();

        foreach($permission as $permission) {
            $role_admin->givePermissionTo($permission->name);
        }

        $role_user->givePermissionTo('peminjamanAktifKendaraan.index');
        $role_user->givePermissionTo('peminjamanAktifKendaraan.store');
        $role_user->givePermissionTo('peminjamanAktifKendaraan.returning');
        $role_user->givePermissionTo('peminjamanAktifKendaraan.update');

        $role_user->givePermissionTo('riwayatPeminjamanKendaraan.index');
        $role_user->givePermissionTo('riwayatPeminjamanKendaraan.detail');

        $role_user->givePermissionTo('peminjamanAktifTools.index');
        $role_user->givePermissionTo('peminjamanAktifTools.store');
        $role_user->givePermissionTo('peminjamanAktifTools.returning');
        $role_user->givePermissionTo('peminjamanAktifTools.update');

        $role_user->givePermissionTo('riwayatPeminjamanTools.index');
        $role_user->givePermissionTo('riwayatPeminjamanTools.detail');
    }
}
