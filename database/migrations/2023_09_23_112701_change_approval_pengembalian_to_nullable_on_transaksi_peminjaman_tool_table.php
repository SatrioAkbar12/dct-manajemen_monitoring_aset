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
        Schema::table('transaksi_peminjaman_tool', function (Blueprint $table) {
            $table->boolean('aktif')->nullable()->change();
            $table->boolean('approval_pengembalian')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_peminjaman_tool', function (Blueprint $table) {
            $table->boolean('aktif')->nullable(false)->change();
            $table->boolean('approval_pengembalian')->nullable(false)->default(0)->change();
        });
    }
};
