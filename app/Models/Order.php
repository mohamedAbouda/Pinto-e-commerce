<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id','address_id','status','note','total_price','dispute_comment','postal_code','payment_method','created_at','updated_at','coupon_id','total_price_after_discount'];

    public function items()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }

    public function user()
    {
        return $this->belongsTo(Client::class , 'user_id');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
}
