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
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->boolean('enable_max_vacation_length')->default(0)->after('calendar_height');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->dropColumn('enable_max_vacation_length');
        });
    }
};
