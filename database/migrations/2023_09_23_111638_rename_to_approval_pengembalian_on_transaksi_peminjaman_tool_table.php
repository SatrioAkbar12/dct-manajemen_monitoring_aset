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
            $table->renameColumn('approved', 'approval_pengembalian');
            $table->renameColumn('keterangan_approved', 'keterangan_approval_pengembalian');
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
            $table->renameColumn('approval_pengembalian', 'approved');
            $table->renameColumn('keterangan_approval_pengembalian', 'keterangan_approved');
        });
    }
};
