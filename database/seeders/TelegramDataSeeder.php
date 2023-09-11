<?php

namespace Database\Seeders;

use App\Models\TelegramData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TelegramDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TelegramData::updateOrCreate(['tipe' => 'group'], ['id_telegram' => null, 'username' => null]);
        TelegramData::updateOrCreate(['tipe' => 'channel'], ['id_telegram' => null, 'username' => null]);
    }
}
