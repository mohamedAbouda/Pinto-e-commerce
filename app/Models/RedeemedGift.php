<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeemedGift extends Model
{
    protected $connection = 'mysql';
    protected $fillable=[
        'user_id',
        'type',
        'object_id',
    ];
}
