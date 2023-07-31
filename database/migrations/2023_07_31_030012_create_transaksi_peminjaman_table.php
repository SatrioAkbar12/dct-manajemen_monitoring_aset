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
        Schema::create('transaksi_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("id_kendaraan");
            $table->unsignedBigInteger("id_user");
            $table->dateTime("tanggal_waktu_kembali");
            $table->boolean("aktif");
            $table->string("status_kondisi");
            $table->text("kendala_kondisi");
            $table->string("foto_kondisi");

            $table->foreign("id_kendaraan")->references("id")->on("kendaraan")->onDelete("cascade");
            $table->foreign("id_user")->references("id")->on("users")->onDelete("cascade");

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
        Schema::dropIfExists('transaksi_peminjaman');
    }
};
