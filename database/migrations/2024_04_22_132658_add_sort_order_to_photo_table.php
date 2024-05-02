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
            $table->unsignedSmallInteger('sort_order')->default(100)->after('album_id');
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
            $table->dropColumn('sort_order');
        });
    }
};
