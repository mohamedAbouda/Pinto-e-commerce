<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_categories';
    protected $fillable = ['name'];

    /**
    * Relations
    */
    public function articles()
    {
        return $this->belongsToMany(BlogArticle::class ,'blog_article_categories' ,'blog_category_id' ,'blog_article_id');
    }
}
