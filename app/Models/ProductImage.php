<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ProductImage extends Model
{
    protected $connection = 'mysql';
    protected $table = 'product_images';
    protected $fillable = [
        'image' ,'product_id'
    ];

     protected $appends = ['image_url'];
    public $upload_distination = '/uploads/images/products/';

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('public/'.$this->upload_distination.$this->image) : '';
    }

       public function setImageAttribute($value)
    { 
        if (!$value instanceof UploadedFile) {
            $this->attributes['image'] = $value;
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['image'] = $image_name;
    }
}
