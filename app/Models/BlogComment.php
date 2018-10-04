<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blog_comments';
    protected $dates = ['created_at'];
    protected $fillable = ['blog_article_id','comment' ,'comment_id' ,'client_id'];

    /**
    * Relations
    */
    public function article()
    {
        return $this->belongsTo(BlogArticle::class ,'blog_article_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class ,'client_id');
    }
}
