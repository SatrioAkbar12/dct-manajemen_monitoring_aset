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
            $table->renameColumn('foto', 'foto_depan');
            $table->string('foto_belakang');
            $table->string('foto_kanan');
            $table->string('foto_kiri');
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
            $table->dropColumn('foto_kiri');
            $table->dropColumn('foto_kanan');
            $table->dropColumn('foto_belakang');
            $table->renameColumn('foto_depan', 'foto');
        });
    }
};
