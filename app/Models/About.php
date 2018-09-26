<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class About extends Model
{
    protected $table = 'about';
    protected $fillable=['description' ,'about_header' ,'mission_header' ,'mission_description' ,'brand_image' ,'mission_image'];
    protected $appends = ['brand_image_url' , 'mission_image_url'];
    public $upload_distination = '/uploads/images/about/';
    /**
     * Accessors & Mutators
     */
     public function setBrandImageAttribute($value)
     {
         if (!$value instanceof UploadedFile) {
             $this->attributes['brand_image'] = $value;
             return;
         }
         $image_name = str_random(60);
         $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
         $value->move(public_path($this->upload_distination),$image_name);
         $this->attributes['brand_image'] = $image_name;
     }

     public function getBrandImageUrlAttribute()
     {
         return strpos($this->brand_image, 'http') === false ? asset('public/'.$this->upload_distination.$this->brand_image) : $this->brand_image;
     }

     public function setMissionImageAttribute($value)
     {
         if (!$value instanceof UploadedFile) {
             $this->attributes['mission_image'] = $value;
             return;
         }
         $image_name = str_random(60);
         $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
         $value->move(public_path($this->upload_distination),$image_name);
         $this->attributes['mission_image'] = $image_name;
     }

     public function getMissionImageUrlAttribute()
     {
         return strpos($this->mission_image, 'http') === false ? asset('public/'.$this->upload_distination.$this->mission_image) : $this->mission_image;
     }
}
