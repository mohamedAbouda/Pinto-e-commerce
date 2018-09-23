<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'mysql';
    protected $fillable = ['user_id','seen'];

    /**
     * Relations
     */
    public function items()
    {
        return $this->belongsToMany(Product::class , 'cart_item', 'cart_id')->withPivot('amount','color_id','size_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
