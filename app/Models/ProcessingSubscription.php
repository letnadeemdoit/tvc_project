<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessingSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'plan_id',
        'plan',
        'period',
        'status'
    ];

    public function subscription(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
