<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $connection = 'mysql';
    protected $table = 'subscribers';
    protected $fillable = ['email','name'];
}
