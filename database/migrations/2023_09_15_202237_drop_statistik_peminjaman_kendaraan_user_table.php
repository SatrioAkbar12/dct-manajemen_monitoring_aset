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
        Schema::dropIfExists('statistik_peminjaman_kendaraan_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('statistik_peminjaman_kendaraan_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kendaraan');
            $table->unsignedInteger('jumlah');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraan')->onDelete('cascade');
        });
    }
};
