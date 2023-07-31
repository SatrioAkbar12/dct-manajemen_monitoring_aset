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
        Schema::create('masa_aktif_dokumen_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("id_kendaraan");
            $table->unsignedBigInteger("id_tipe_dokumen");
            $table->date("tanggal_masa_berlaku");

            $table->foreign("id_kendaraan")->references("id")->on("kendaraan")->onDelete("cascade");
            $table->foreign("id_tipe_dokumen")->references("id")->on("tipe_dokumen_kendaraan")->onDelete("cascade");

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
        Schema::dropIfExists('masa_aktif_dokumen_kendaraan');
    }
};
