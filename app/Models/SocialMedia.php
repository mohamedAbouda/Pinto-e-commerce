<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $connection = 'mysql';
    protected $table="social_media";

    protected $fillable=[
        'title',
        'icon',
        'url',
    ];

}
