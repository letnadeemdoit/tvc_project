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
        Schema::table('House', function (Blueprint $table) {
            $table->string('local_guide_email_list')->after('request_to_use_house_email_list')->nullable();
            $table->string('guest_book_email_list')->after('local_guide_email_list')->nullable();
            $table->string('photo_email_list')->after('guest_book_email_list')->nullable();
            $table->string('food_item_list')->after('photo_email_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('House', function (Blueprint $table) {
            $table->dropColumn('local_guide_email_list');
            $table->dropColumn('guest_book_email_list');
            $table->dropColumn('photo_email_list');
            $table->dropColumn('food_item_list');
        });
    }
};
