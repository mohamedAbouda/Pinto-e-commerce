<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $table = 'gift_cards';
    /*
    is active
    1 :yes
    0:no
    */
    protected $fillable=[
        'code',
        'name',
        'discount',
        'is_active',
    ];
}
