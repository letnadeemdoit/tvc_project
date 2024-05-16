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
        Schema::table('Vacations', function (Blueprint $table) {
            $table->boolean('is_calendar_task')->default(0)->after('is_vac_approved');
            $table->integer('EndRepeatDateId')->default(0)->after('is_calendar_task');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Vacations', function (Blueprint $table) {
            $table->dropColumn('is_calendar_task');
            $table->dropColumn('EndRepeatDateId');
        });
    }
};
