<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Srmklive\PayPal\Facades\PayPal;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'house_id',
        'subscription_id',
        'plan_id',
        'plan',
        'period',
        'status'
    ];

    public function cancel()
    {
        $paypal = PayPal::setProvider();
        $paypal->getAccessToken();
        $paypal->cancelSubscription($this->subscription_id, '-');
    }
}
