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
        Schema::create('list_tools_transaksi_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('id_peminjaman_tool');
            $table->unsignedBigInteger('id_aset');

            $table->foreign('id_peminjaman_tool')->references('id')->on('transaksi_peminjaman_tool')->onDelete('cascade');
            $table->foreign('id_aset')->references('id')->on('aset')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_tools_transaksi_peminjaman');
    }
};
