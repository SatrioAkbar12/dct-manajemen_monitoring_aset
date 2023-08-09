<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->first();
        $user = User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'memiliki_sim' => 1
        ]);
        $user->assignRole($role->name);

        $faker = Faker::create();;

        for($i = 0; $i < 10; $i++) {
            User::create([
                'username' => $faker->userName(),
                'nama' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make($faker->password()),
                'memiliki_sim' => $faker->boolean()
            ]);
        }
    }
}
