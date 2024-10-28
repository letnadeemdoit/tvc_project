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
        Schema::table('guest_contacts', function (Blueprint $table) {
            $table->string('guest_name')->after('house_id')->nullable();
            $table->string('guest_vac_id')->after('guest_email')->nullable();
            $table->string('guest_vac_color')->after('guest_vac_id')->nullable();
            $table->boolean('is_approved')->after('guest_vac_color')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_contacts', function (Blueprint $table) {
            $table->dropColumn('guest_name');
        });
    }
};
