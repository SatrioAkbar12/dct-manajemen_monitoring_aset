<?php

namespace Database\Seeders;

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
        $jenis_kendaraan = ['Motor', 'Mobil'];
        $faker = Faker::create();

        for($i = 0; $i < 20; $i++) {
            Kendaraan::create([
                'nopol' => strtoupper($faker->bothify('? #### ???')),
                'merk' => $faker->word(),
                'jenis_kendaraan' => $jenis_kendaraan[array_rand($jenis_kendaraan)],
                'warna' => $faker->colorName()
            ]);
        }
    }
}
