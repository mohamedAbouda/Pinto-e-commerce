<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wish_list';
    protected $fillable = ['client_id','product_id'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

      public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
