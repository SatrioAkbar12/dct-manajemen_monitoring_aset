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
        Schema::table('aset', function (Blueprint $table) {
            $table->foreign('id_kepemilikan_aset')->references('id')->on('kepemilikan_aset')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->dropForeign(['id_kepemilikan_aset']);
        });
    }
};
