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
        Schema::create('kondisi_kendaraan_transaksi_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("id_transaksi");
            $table->string("status_kondisi");
            $table->text("deskripsi");
            $table->string("foto");

            $table->foreign("id_transaksi")->references("id")->on("transaksi_peminjaman")->onDelete("cascade");

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kondisi_kendaraan_transaksi_peminjaman');
    }
};
