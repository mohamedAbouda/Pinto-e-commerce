<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id' ,'email' ,'phone' ,'postal_code' ,'address_id' ,'gift_card_id' ,
        'total_price' ,'total_price_after_discount' ,'payment_method' ,'shipping_method_name' ,
        'shipping_method_cost' ,'dispute_comment' ,'note' ,'status' ,'coupon_id'
    ];

    /**
    * Relations
    */
    public function items()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function user()
    {
        return $this->belongsTo(Client::class , 'user_id');
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
