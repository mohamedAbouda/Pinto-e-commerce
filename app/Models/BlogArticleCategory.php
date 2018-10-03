<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogArticleCategory extends Model
{
    protected $table = 'blog_article_categories';
    protected $fillable = ['blog_article_id' ,'blog_category_id'];
}
