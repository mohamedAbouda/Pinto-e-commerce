<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = ['product_id','count','price','order_id'];

    public function order()
	{
    	return $this->belongsTo('App\Models\Order');
	}

	 public function product()
	{
    	return $this->belongsTo('App\Models\Product');
	}
}
