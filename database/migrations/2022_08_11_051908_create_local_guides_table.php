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
        Schema::create('local_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('local_guide_category_id')->nullable();
            $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('house_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('datetime')->nullable();
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
        Schema::dropIfExists('local_guides');
    }
};
