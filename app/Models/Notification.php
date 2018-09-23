<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $connection = 'mysql';
    protected $fillable = ['order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
