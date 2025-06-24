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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('platform')->default('paypal')->after('status');
            $table->longText('apple_jwt_token')->nullable()->after('platform');
            $table->timestamp('expires_at')->nullable()->after('apple_jwt_token');
            $table->string('transaction_type')->nullable()->after('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn(['platform', 'apple_jwt_token', 'expires_at', 'transaction_type']);
        });
    }
};
