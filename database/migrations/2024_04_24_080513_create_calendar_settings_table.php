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
        Schema::create('calendar_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('house_id');
            $table->boolean('enable_schedule_window')->default(0);
            $table->integer('StartDateId')->default(0);
            $table->integer('EndDateId')->default(0);
            $table->boolean('owner_vacation_approval')->default(0);
            $table->integer('StartTimeId')->default(13);
            $table->integer('EndTimeId')->default(12);
            $table->string('calendar_style')->nullable();
            $table->string('calendar_height')->default('fixed');
            $table->unsignedSmallInteger('vacation_length')->default(0);
            $table->string('overlap_vacation')->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_settings');
    }
};
