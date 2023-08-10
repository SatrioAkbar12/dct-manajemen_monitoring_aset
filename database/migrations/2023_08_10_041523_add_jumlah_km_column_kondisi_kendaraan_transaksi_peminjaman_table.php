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
            $table->unsignedBigInteger('jumlah_km');
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
            $table->dropColumn('jumlah_km');
        });
    }
};
