<?php

namespace App\Models\Paypal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionInfo extends Model
{
    use HasFactory;

    protected $table = 'paypal_subscription_info';

    protected $primaryKey = 'subscr_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'subscr_id',
        'sub_event',
        'subscr_date',
        'subscr_effective',
        'period1',
        'period2',
        'period3',
        'amount1',
        'amount2',
        'amount3',
        'mc_amount1',
        'mc_amount2',
        'mc_amount3',
        'recurring',
        'reattempt',
        'retry_at',
        'recur_times',
        'username',
        'password',
        'payment_txn_id',
        'subscriber_emailaddress',
        'datecreation',
        'custom',
    ];
}
