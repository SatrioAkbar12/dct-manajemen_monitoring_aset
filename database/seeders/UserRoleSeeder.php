<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();
        $role = Role::all();

        foreach($user as $user) {
            foreach($role as $role) {
                UserRole::create([
                    'id_user' => $user->id,
                    'id_role' => $role->id
                ]);
            }
        }
    }
}
