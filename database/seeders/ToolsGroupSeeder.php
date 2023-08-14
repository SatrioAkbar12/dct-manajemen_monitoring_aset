<?php

namespace Database\Seeders;

use App\Models\ToolsGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ToolsGroup::create(['nama' => 'IT-Network']);
        ToolsGroup::create(['nama' => 'IT-Listrik']);
        ToolsGroup::create(['nama' => 'Utility']);
    }
}
