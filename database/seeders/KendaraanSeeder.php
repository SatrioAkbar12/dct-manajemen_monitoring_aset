<?php

namespace Database\Seeders;

use App\Models\JenisKendaraan;
use App\Models\Kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah_jenis_kendaraan = JenisKendaraan::count();
        $faker = Faker::create();

        for($i = 0; $i < 20; $i++) {
            Kendaraan::create([
                'nopol' => strtoupper($faker->bothify('? #### ???')),
                'merk' => $faker->word(),
                'id_jenis_kendaraan' => rand(1, $jumlah_jenis_kendaraan),
                'warna' => $faker->colorName()
            ]);
        }
    }
}
