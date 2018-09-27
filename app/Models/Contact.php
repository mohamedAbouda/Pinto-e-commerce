<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = [
        'email','address','phones','facebook','instagram','twitter','google' ,
        'store_location_title_1' ,'store_location_address_1' ,'store_location_hours_1' ,
        'store_location_title_2' ,'store_location_address_2' ,'store_location_hours_2' ,
        'store_location_title_3' ,'store_location_address_3' ,'store_location_hours_3' ,
    ];
}
