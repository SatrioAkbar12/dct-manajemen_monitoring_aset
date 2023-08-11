<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use App\Models\ServisRutinKendaraan;
use Carbon\Carbon;
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
        $kendaraan = Kendaraan::all();

        foreach($kendaraan as $kendaraan) {
            $tanggal_servis = Carbon::parse($faker->dateTimeThisYear())->setTimezone('Asia/Jakarta');
            $tanggal_target = Carbon::parse($tanggal_servis)->addMonths(6);

            ServisRutinKendaraan::create([
                'id_kendaraan' => $kendaraan->id,
                'tanggal_servis' => $tanggal_servis,
                // 'penggantian_oli' => $faker->boolean(),
                // 'cek_aki' => $faker->boolean(),
                // 'cek_rem' => $faker->boolean(),
                // 'cek_kopling' => $faker->boolean(),
                // 'cek_ban' => $faker->boolean(),
                // 'cek_lampu' => $faker->boolean(),
                // 'cek_ac' => $faker->boolean(),
                'km_target' => (floor($kendaraan->km_saat_ini/10000)+1)*10000,
                'tanggal_target' => $tanggal_target,
                'detail_servis' => $faker->text,
            ]);
        }
    }
}
