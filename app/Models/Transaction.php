<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $connection = 'mysql';
    protected $fillable=[
        'order_id',
        'payment_method_id',
        'paypal_payment_id', // only for PayPal
        'token',
        'paypal_payer_id', // only for PayPal
        'price',
    ];
}
