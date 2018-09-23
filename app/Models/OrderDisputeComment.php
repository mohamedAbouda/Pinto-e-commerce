<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDisputeComment extends Model
{
    protected $table = 'order_dispute_comments';
    protected $fillable = [
        'client_id' ,'merchant_id' ,'order_id' ,'dispute_comment'
    ];
}
