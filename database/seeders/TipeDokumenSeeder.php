<?php

namespace Database\Seeders;

use App\Models\TipeDokumenKendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeDokumenKendaraan::create(['nama_dokumen' => 'STNK']);
        TipeDokumenKendaraan::create(['nama_dokumen' => 'Pajak']);
        TipeDokumenKendaraan::create(['nama_dokumen' => 'BPKB']);
    }
}
