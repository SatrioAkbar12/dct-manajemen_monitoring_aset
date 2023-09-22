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
            $table->renameColumn('foto_depan', 'foto_depan_kembali');
            $table->renameColumn('foto_belakang', 'foto_belakang_kembali');
            $table->renameColumn('foto_kanan', 'foto_kanan_kembali');
            $table->renameColumn('foto_kiri', 'foto_kiri_kembali');
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
            $table->renameColumn('foto_depan_kembali', 'foto_depan');
            $table->renameColumn('foto_belakang_kembali', 'foto_belakang');
            $table->renameColumn('foto_kanan_kembali', 'foto_kanan');
            $table->renameColumn('foto_kiri_kembali', 'foto_kiri');
        });
    }
};
