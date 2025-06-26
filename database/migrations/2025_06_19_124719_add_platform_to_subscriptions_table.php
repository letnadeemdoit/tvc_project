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
            // Your existing fields
            $table->string('platform')->default('paypal')->after('status');
            $table->longText('apple_jwt_token')->nullable()->after('platform');
            $table->timestamp('expires_at')->nullable()->after('apple_jwt_token');
            $table->string('transaction_type')->nullable()->after('expires_at');

            // New fields for Apple subscription management
            $table->timestamp('cancelled_at')->nullable()->after('transaction_type');
            $table->string('original_transaction_id')->nullable()->after('cancelled_at');

            // Add indexes for performance
            $table->index(['user_id', 'house_id', 'status']);
            $table->index(['expires_at']);
            $table->index(['cancelled_at']);
            $table->index(['platform']);
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
            // Drop indexes first
            $table->dropIndex(['user_id', 'house_id', 'status']);
            $table->dropIndex(['expires_at']);
            $table->dropIndex(['cancelled_at']);
            $table->dropIndex(['platform']);

            // Drop all columns
            $table->dropColumn([
                'platform',
                'apple_jwt_token',
                'expires_at',
                'transaction_type',
                'cancelled_at',
                'original_transaction_id'
            ]);
        });
    }
};
