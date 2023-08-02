<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();;

        for($i = 0; $i < 10; $i++) {
            User::create([
                'username' => $faker->userName(),
                'nama' => $faker->name(),
                'email' => $faker->email(),
                'password' => $faker->password(),
                'memiliki_sim' => $faker->boolean()
            ]);
        }
    }
}
