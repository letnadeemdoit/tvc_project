<?php

namespace App\Models\Paypal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;

    protected $table = 'paypal_payment_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'buyer_email',
        'street',
        'city',
        'state',
        'zipcode',
        'memo',
        'itemname',
        'itemnumber',
        'os0',
        'on0',
        'os1',
        'on1',
        'quantity',
        'paymentdate',
        'paymenttype',
        'txnid',
        'mc_gross',
        'mc_fee',
        'paymentstatus',
        'pendingreason',
        'pendingreason',
        'txntype',
        'tax',
        'mc_currency',
        'reasoncode',
        'custom',
        'country',
        'datecreation',
    ];


}
