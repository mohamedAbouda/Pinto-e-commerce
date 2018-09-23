<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $connection = 'mysql';
    protected $table = 'blog_posts';
    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_post_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }
}
