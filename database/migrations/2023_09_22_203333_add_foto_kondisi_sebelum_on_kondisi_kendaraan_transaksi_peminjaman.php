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
            $table->string('foto_depan_pinjam')->nullable();
            $table->string('foto_belakang_pinjam')->nullable();
            $table->string('foto_kanan_pinjam')->nullable();
            $table->string('foto_kiri_pinjam')->nullable();
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
            $table->dropColumn('foto_depan_pinjam');
            $table->dropColumn('foto_belakang_pinjam');
            $table->dropColumn('foto_kanan_pinjam');
            $table->dropColumn('foto_kiri_pinjam');
        });
    }
};
