<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Image;

class Brand extends Model
{
    protected $fillable = [
        'name' ,'image'
    ];
    protected $appends = ['image_url'];
    public $upload_distination = '/uploads/images/brands/';

    public function setImageAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['image'] = '';
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['image'] = $image_name;
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('public'.$this->upload_distination.$this->image) : '';
    }

    /**
    * Relations
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
