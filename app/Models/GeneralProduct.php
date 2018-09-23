<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralProduct extends Model
{
    protected $table = 'general_products';
    protected $fillable = ['sub_category_id','shipping_cost','weight','product_id','shipping_category','related_products','discount_percentage','count'];
}
