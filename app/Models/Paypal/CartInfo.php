<?php

namespace App\Models\Paypal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartInfo extends Model
{
    use HasFactory;

    protected $table = 'paypal_cart_info';

    protected $primaryKey = 'txnid';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'txnid',
        'itemname',
        'itemnumber',
        'os0',
        'on0',
        'os1',
        'on1',
        'quantity',
        'invoice',
        'custom',
    ];

}
