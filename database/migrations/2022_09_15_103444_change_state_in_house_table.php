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
        Schema::table('House', function (Blueprint $table) {
            $table->string('State')->nullable()->change();
            $table->string('City')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('House', function (Blueprint $table) {
           $table->dropColumn('State');
           $table->dropColumn('City');
        });
    }
};
