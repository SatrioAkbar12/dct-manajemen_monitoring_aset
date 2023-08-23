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
            $table->string('status_kondisi')->nullable(true)->change();
            $table->string('deskripsi')->nullable(true)->change();
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
            $table->string('status_kondisi')->nullable(false)->change();
            $table->string('deskripsi')->nullable(false)->change();
        });
    }
};
