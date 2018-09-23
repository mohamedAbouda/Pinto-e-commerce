<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{
    protected $table = 'discount_products';
    protected $fillable = ['product_id','count','discount'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
