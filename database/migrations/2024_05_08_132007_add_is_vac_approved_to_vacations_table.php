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
            $table->boolean('is_vac_approved')->default(0)->after('VacationId');
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
            $table->dropColumn('is_vac_approved');
        });
    }
};
