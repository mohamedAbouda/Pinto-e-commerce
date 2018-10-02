<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $connection = 'mysql';
    protected $fillable = ['code' , 'percentage'];
    protected $hidden = ['created_at' , 'updated_at'];
}
