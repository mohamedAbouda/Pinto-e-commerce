<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $connection = 'mysql';
    protected $table = 'support_messages';
    protected $fillable = ['name','email','message','seen'];
    protected $hidden = ['created_at','updated_at'];

    /**
     * Override
     */

}
