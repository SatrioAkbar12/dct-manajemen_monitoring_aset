<?php

namespace Database\Seeders;

use App\Models\KepemilikanAset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepemilikanAsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KepemilikanAset::create(['nama' => 'PT. DCT Total Solution', 'prefix' => 'DCT']);
        KepemilikanAset::create(['nama' => 'PT. Dakara Citra Tangguh', 'prefix' => 'DKR']);
    }
}
