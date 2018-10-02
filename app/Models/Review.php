<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'product_review';
    protected $fillable = ['product_id' , 'name' , 'review' , 'rate','client_id','approved'];

     public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

      public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
