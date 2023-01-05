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
        Schema::create('processing_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id');
            $table->string('plan_id')->comment('Paypal plan id');
            $table->string('plan', 30);
            $table->string('period', 30);
            $table->string('status', 100);
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
        Schema::dropIfExists('processing_subscriptions');
    }
};
