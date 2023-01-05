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
        Schema::table('vacation_rooms', function (Blueprint $table) {
            $table->dateTime('starts_at')->change();
            $table->dateTime('ends_at')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacation_rooms', function (Blueprint $table) {
            $table->date('starts_at')->change();
            $table->date('ends_at')->change();
        });
    }
};
