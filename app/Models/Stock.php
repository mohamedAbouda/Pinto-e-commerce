<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $fillable = ['product_id','amount','note','size','color','sku','brand_id','weight'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

      public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
