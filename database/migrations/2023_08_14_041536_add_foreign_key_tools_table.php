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
        Schema::table('tools', function (Blueprint $table) {
            $table->foreign('id_aset')->references('id')->on('aset')->onDelete('cascade');
            $table->foreign('id_tools_group')->references('id')->on('tools_groups')->onDelete('cascade');
            $table->foreign('id_gudang')->references('id')->on('gudang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->dropForeign(['id_gudang']);
            $table->dropForeign(['id_tools_group']);
            $table->dropForeign(['id_aset']);
        });
    }
};
