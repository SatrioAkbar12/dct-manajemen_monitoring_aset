<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servis_rutin_kendaraan', function (Blueprint $table) {
            $table->dropColumn([
                'penggantian_oli',
                'cek_aki',
                'cek_rem',
                'cek_kopling',
                'cek_ban',
                'cek_lampu',
                'cek_ac',
            ]);

            $table->text('detail_servis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servis_rutin_kendaraan', function (Blueprint $table) {
            $table->dropColumn('detail_servis');

            $table->boolean("penggantian_oli");
            $table->boolean("cek_aki");
            $table->boolean("cek_rem");
            $table->boolean("cek_kopling");
            $table->boolean("cek_ban");
            $table->boolean("cek_lampu");
            $table->boolean("cek_ac");
        });
    }
};
