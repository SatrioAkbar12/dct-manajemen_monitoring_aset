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
        Schema::table('kondisi_kendaraan_transaksi_peminjaman', function (Blueprint $table) {
            $table->string('status_kondisi')->nullable(true)->change();
            $table->text('deskripsi')->nullable(true)->change();
            $table->string('foto_depan')->nullable(true)->change();
            $table->string('foto_belakang')->nullable(true)->change();
            $table->string('foto_kanan')->nullable(true)->change();
            $table->string('foto_kiri')->nullable(true)->change();
            $table->integer('km_terakhir')->nullable(true)->change();
            $table->string('jumlah_km')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kondisi_kendaraan_transaksi_peminjaman', function (Blueprint $table) {
            $table->string('status_kondisi')->nullable(false)->change();
            $table->text('deskripsi')->nullable(false)->change();
            $table->string('foto_depan')->nullable(false)->change();
            $table->string('foto_belakang')->nullable(false)->change();
            $table->string('foto_kanan')->nullable(false)->change();
            $table->string('foto_kiri')->nullable(false)->change();
            $table->integer('km_terakhir')->nullable(false)->change();
            $table->string('jumlah_km')->nullable(false)->change();
        });
    }
};
