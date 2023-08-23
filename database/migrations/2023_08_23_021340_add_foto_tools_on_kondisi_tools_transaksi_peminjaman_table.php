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
        Schema::table('kondisi_tools_transaksi_peminjaman', function (Blueprint $table) {
            $table->string('foto_sebelum')->nullable();
            $table->string('foto_sesudah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kondisi_tools_transaksi_peminjaman', function (Blueprint $table) {
            $table->dropColumn('foto_sebelum');
            $table->dropColumn('foto_sesudah');
        });
    }
};
