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
        Schema::table('Photo', function (Blueprint $table) {
            $table->unsignedBigInteger('album_id');
            $table->string('description')->nullable();
            $table->string('path')->nullable();

            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Photo', function (Blueprint $table) {
            $table->dropColumn('album_id');
            $table->dropColumn('description');
        });
    }
};
