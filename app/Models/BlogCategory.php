<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $connection = 'mysql';
    protected $table = 'blog_categories';
}
