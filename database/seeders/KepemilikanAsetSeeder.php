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
        KepemilikanAset::create(['nama' => 'DCT', 'prefix' => 'DCT']);
        KepemilikanAset::create(['nama' => 'Dakara', 'prefix' => 'DKR']);
    }
}
