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
        Schema::table('Board', function (Blueprint $table) {
            $table->string('title')->nullable()->after('Audit_Email');
            $table->string('image')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Board', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('image');
        });
    }
};
