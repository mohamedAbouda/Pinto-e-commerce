<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model
{
    protected $table = 'store_locations';
    protected $fillable = ['address','longitude','latitude'];
}
