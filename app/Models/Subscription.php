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
        'is_migrated',
        'status',
        'platform',
        'apple_jwt_token',
        'expires_at',
        'transaction_type',
    ];

    protected $casts = [
        'is_migrated' => 'boolean',
    ];


    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'HouseID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function cancel()
    {
        ProcessingSubscription::create([
            'subscription_id' => $this->id,
            'plan_id' =>$this->plan_id,
            'plan' => $this->plan,
            'period' => $this->period,
            'status' => 'APPROVAL_PENDING',
        ]);
        $paypal = PayPal::setProvider();
        $paypal->getAccessToken();
        $paypal->cancelSubscription($this->subscription_id, '-');
    }

    public function processingSubscriptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProcessingSubscription::class);
    }
}
