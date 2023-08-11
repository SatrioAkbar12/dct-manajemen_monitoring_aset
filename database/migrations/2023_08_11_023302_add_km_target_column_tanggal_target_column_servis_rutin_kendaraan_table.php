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
        Schema::table('servis_rutin_kendaraan', function (Blueprint $table) {
            $table->unsignedBigInteger('km_target');
            $table->date('tanggal_target')->default('0001-01-01');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servis_rutin_kendaraan', function (Blueprint $table) {
            $table->dropColumn('km_target');
            $table->dropColumn('tanggal_target');
        });
    }
};
