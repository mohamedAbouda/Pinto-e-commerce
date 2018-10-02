<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOption extends Model
{
    protected $connection = 'mysql';
    protected $table='delivery_options';
    protected $fillable=[
        'name',
        'icon',
        'availability',
        'price'
    ];

}
