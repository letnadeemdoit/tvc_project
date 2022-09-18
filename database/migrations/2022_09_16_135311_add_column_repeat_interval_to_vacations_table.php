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
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedSmallInteger('repeat_interval')->default(0);

            $table->foreign('parent_id')->references('VacationId')->on('Vacations')->onDelete('cascade');
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
            $table->dropColumn('repeat_interval');
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};
