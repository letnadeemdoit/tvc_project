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
            $table->boolean('enable_calendar_access')->default(0)->after('allow_informational_entries');
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
            $table->dropColumn('enable_calendar_access');
        });
    }
};
