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
            $table->boolean('allow_guest_vacations')->default(0)->after('overlap_vacation');
            $table->boolean('allow_informational_entries')->default(0)->after('allow_guest_vacations');
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
            $table->dropColumn('allow_guest_vacations');
            $table->dropColumn('allow_informational_entries');
        });
    }
};
