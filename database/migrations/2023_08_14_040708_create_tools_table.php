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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_aset');
            $table->string('nama');
            $table->string('merk');
            $table->string('model')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('status_saat_ini')->nullable();
            $table->unsignedBigInteger('id_tools_group');
            $table->unsignedBigInteger('id_gudang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools');
    }
};
