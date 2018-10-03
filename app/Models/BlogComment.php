<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blog_comments';
    protected $fillable = ['blog_article_id','comment' ,'comment_id' ,'user_id'];
}
