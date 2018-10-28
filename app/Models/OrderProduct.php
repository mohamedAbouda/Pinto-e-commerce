<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    protected $fillable = ['product_id','amount','price_per_item','color_id','size_id','order_id'];

    /**
     * Relations
     */
     public function product()
     {
         return $this->belongsTo(Product::class);
     }
}
