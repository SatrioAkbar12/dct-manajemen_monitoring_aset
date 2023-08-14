<?php

namespace Database\Seeders;

use App\Models\Gudang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gudang::create(['nama' => 'Gudang RGG']);
        Gudang::create(['nama' => 'Gudang Rawalumbu']);
        Gudang::create(['nama' => 'Office']);
    }
}
