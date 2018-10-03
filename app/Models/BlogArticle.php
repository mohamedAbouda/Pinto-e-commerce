<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class BlogArticle extends Model
{
    protected $fillable = ['title' ,'cover_image' ,'body'];
    protected $dates = ['created_at'];
    public $upload_distination = '/uploads/images/blog/';

    /**
    * Accessors & Mutators
    */

    private function upload($field ,$value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes[$field] = $value;
            return;
        }
        $name = str_random(60);
        $name = $name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$name);
        $this->attributes[$field] = $name;
    }

    public function setCoverImageAttribute($value)
    {
        $this->upload('cover_image' ,$value);
    }

    public function getCoverImageUrlAttribute()
    {
        return strpos($this->cover_image, 'http') === false ? asset('public/'.$this->upload_distination.$this->cover_image) : $this->cover_image;
    }

    /**
    * Relations
    */
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class ,'blog_article_categories' ,'blog_article_id' ,'blog_category_id');
    }
}
