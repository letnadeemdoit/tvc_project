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
            $table->unsignedBigInteger('country')->nullable()->after('Address2');
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
            $table->dropColumn('country');
        });
    }
};
