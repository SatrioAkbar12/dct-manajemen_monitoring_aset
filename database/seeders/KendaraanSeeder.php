<?php

namespace Database\Seeders;

use App\Models\Aset;
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
            $prefix_jenis_kendaraan = "0" . rand(1, $jumlah_jenis_kendaraan);
            $kode_aset = 'TRAN' . $prefix_jenis_kendaraan;

            $aset = Aset::where('kode_aset', 'like', $kode_aset.'%')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();
            $id = 1;

            if($aset != null) {
                $id = intval(substr($aset->kode_aset, -3)) + 1;
            }

            if($id < 10) {
                $kode_aset = $kode_aset . '00' . $id;
            }
            else {
                $kode_aset = $kode_aset . '0' . $id;
            }

            $aset = Aset::create([
                'kode_aset' => $kode_aset,
            ]);

            Kendaraan::create([
                'nopol' => strtoupper($faker->bothify('? #### ???')),
                'merk' => $faker->word(),
                'id_jenis_kendaraan' => rand(1, $jumlah_jenis_kendaraan),
                'warna' => $faker->colorName(),
                'tipe' => $faker->word(),
                'km_saat_ini' => $faker->randomNumber(6, false),
                'id_aset' => $aset->id,
            ]);
        }
    }
}
