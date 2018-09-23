<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $connection = 'mysql';
    protected $table = 'pages';
    protected $fillable = ['title','content','url','encoded_title'];
}
