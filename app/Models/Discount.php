<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $connection = 'mysql';
    protected $fillable=[
        'activation_start',
        'activation_end',
        'active',
        'percentage',
        'product_id'
    ];

    protected $dates = ['activation_end' ,'activation_start'];
   // protected $dateFormat = 'Y-m-d H:i';
    /**
    * Accessors & Mutators
    */

    /**
    * Relations
    */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
