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
        Schema::table('transaksi_peminjaman_kendaraan', function (Blueprint $table) {
            $table->string('geolocation_pinjam')->nullable();
            $table->string('geolocation_kembali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_peminjaman_kendaraan', function (Blueprint $table) {
            $table->dropColumn('geolocation_pinjam');
            $table->dropColumn('geolocation_kembali');
        });
    }
};
