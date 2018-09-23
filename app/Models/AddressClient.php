<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressClient extends Model
{
    protected $table = 'address_client';
    protected $fillable = ['address_id','client_id'];
}
