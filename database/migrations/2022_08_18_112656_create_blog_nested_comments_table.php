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
        Schema::create('blog_nested_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id');
            $table->foreignId('user_id');
            $table->foreignId('comment_id');
            $table->string('author');
            $table->text('nested_content');
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
        Schema::dropIfExists('blog_nested_comments');
    }
};
