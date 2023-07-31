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
        Schema::create('servis_rutin_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("id_kendaraan");
            $table->boolean("penggantian_oli");
            $table->boolean("cek_aki");
            $table->boolean("cek_rem");
            $table->boolean("cek kopling");
            $table->boolean("cek_ban");
            $table->boolean("cek_lampu");
            $table->boolean("cek_ac");
            $table->date("tanggal_servis");

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servis_rutin_kendaraan');
    }
};
