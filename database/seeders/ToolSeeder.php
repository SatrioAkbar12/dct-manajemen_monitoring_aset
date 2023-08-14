<?php

namespace Database\Seeders;

use App\Models\Aset;
use App\Models\Gudang;
use App\Models\Tool;
use App\Models\ToolsGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah_gudang = Gudang::count();
        $jumlah_tools_group = ToolsGroup::count();
        $faker = Faker::create();

        for($i = 0; $i < 20; $i++) {
            $prefix_group_tools = "0" . rand(1, $jumlah_tools_group);
            $kode_aset = 'TOOL' . $prefix_group_tools;

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
                'tipe_aset' => 'tool',
            ]);

            Tool::create([
                'id_aset' => $aset->id,
                'nama' => $faker->sentence(3),
                'merk' => ucfirst($faker->word()),
                'model' => ucwords($faker->bothify('???-####')),
                'deskripsi' => $faker->text(),
                'status_saat_ini' => 'Digudang',
                'id_gudang' => rand(1, $jumlah_gudang),
                'id_tools_group' => rand(1, $jumlah_tools_group),
            ]);
        }
    }
}
