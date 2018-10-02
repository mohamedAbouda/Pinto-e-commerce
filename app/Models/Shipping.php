<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping';
    protected $fillable = ['shipping_and_return'];
}
