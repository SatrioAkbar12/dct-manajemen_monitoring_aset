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
        Schema::table('statistik_peminjaman_kendaraan_user', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kendaraan')->references('id')->on('kendaraan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statistik_peminjaman_kendaraan_user', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_kendaraan']);
        });
    }
};
