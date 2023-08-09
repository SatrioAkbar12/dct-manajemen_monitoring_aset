<?php

namespace Database\Seeders;

use App\Models\JenisKendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisKendaraan::create(['nama' => 'Mobil']);
        JenisKendaraan::create(['nama' => 'Motor']);
    }
}
