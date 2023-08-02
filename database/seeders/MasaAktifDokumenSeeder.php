<?php

namespace Database\Seeders;

use App\Models\MasaAktifDokumenKendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MasaAktifDokumenSeeder extends Seeder
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
            for($dokumen = 1; $dokumen <= 3; $dokumen++) {
                MasaAktifDokumenKendaraan::create([
                    'id_kendaraan' => $kendaraan,
                    'id_tipe_dokumen' => $dokumen,
                    'tanggal_masa_berlaku' => $faker->date
                ]);
            }
        }
    }
}
