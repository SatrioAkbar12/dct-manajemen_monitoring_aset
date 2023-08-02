<?php

namespace Database\Seeders;

use App\Models\ServisRutinKendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServisRutinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($kendaraan = 1; $kendaraan <= 5; $kendaraan++) {
            for($servis = 1; $servis <= 3; $servis++) {
                ServisRutinKendaraan::create([
                    'id_kendaraan' => $kendaraan,
                    'tanggal_servis' => $faker->date(),
                    'penggantian_oli' => $faker->boolean(),
                    'cek_aki' => $faker->boolean(),
                    'cek_rem' => $faker->boolean(),
                    'cek_kopling' => $faker->boolean(),
                    'cek_ban' => $faker->boolean(),
                    'cek_lampu' => $faker->boolean(),
                    'cek_ac' => $faker->boolean()
                ]);
            }
        }
    }
}
