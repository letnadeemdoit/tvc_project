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
        Schema::table('blog_views', function (Blueprint $table) {
            $table->dropColumn('blog_id');
            $table->dropColumn('views');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_views', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id');
            $table->integer('views');
        });
    }
};
