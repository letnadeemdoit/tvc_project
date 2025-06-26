<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Srmklive\PayPal\Facades\PayPal;
use Carbon\Carbon;

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
        // New fields for Apple subscription management
        'cancelled_at',
        'original_transaction_id',
    ];

    protected $casts = [
        'is_migrated' => 'boolean',
        'expires_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // Add dynamic status calculation
    protected $appends = [
        'calculated_status',
        'is_active',
        'is_cancelled',
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'HouseID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Your existing PayPal cancel method
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

    /**
     * Get the calculated status based on current date and expiry
     */
    public function getCalculatedStatusAttribute()
    {
        if (!$this->expires_at) {
            return 'INACTIVE';
        }

        $now = Carbon::now();
        $expiryDate = Carbon::parse($this->expires_at);
        $gracePeriodDays = 3; // 3-day grace period for failed renewals
        $gracePeriodEnd = $expiryDate->copy()->addDays($gracePeriodDays);

        // Check if manually cancelled
        if ($this->cancelled_at) {
            $cancelledDate = Carbon::parse($this->cancelled_at);

            if ($cancelledDate <= $now) {
                if ($expiryDate > $now) {
                    return 'CANCELLED_ACTIVE'; // Cancelled but still active until expiry
                }
                return 'CANCELLED';
            }
        }

        // Check expiry status
        if ($expiryDate > $now) {
            return 'ACTIVE';
        } else if ($gracePeriodEnd > $now) {
            return 'GRACE_PERIOD'; // In grace period for failed renewal
        } else {
            return 'EXPIRED';
        }
    }

    /**
     * Check if subscription is currently active
     */
    public function getIsActiveAttribute()
    {
        $status = $this->calculated_status;
        return in_array($status, ['ACTIVE', 'CANCELLED_ACTIVE', 'GRACE_PERIOD']);
    }

    /**
     * Check if subscription is cancelled
     */
    public function getIsCancelledAttribute()
    {
        return !empty($this->cancelled_at);
    }

    /**
     * Scope to get active subscriptions
     */
    public function scopeActive($query)
    {
        return $query->where('expires_at', '>', Carbon::now());
    }

    /**
     * Scope to get subscriptions by platform
     */
    public function scopePlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }
}
