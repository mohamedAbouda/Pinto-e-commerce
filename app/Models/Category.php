<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Image;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name' ,'image' ,'icon' ,
        'navBar','payment_withhold', 'payment_due_percentage', 'shipping_cost',
        'has_size', 'has_color', 'has_brand','key_word_id'
    ];
    protected $appends = ['image_url'];
    public $objects = [];
    public $upload_distination = 'uploads/images/categories/';

    /**
    * Relations
    */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function keyWord()
    {
        return $this->belongsTo('App\Models\KeyWord','key_word_id');
    }

    public function setImageAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['image'] = $value;
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $resize = Image::make($value)->resize(25 , 25)->save();
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['image'] = $image_name;
    }
    public function getImageUrlAttribute()
    {
        return asset('public/'.$this->upload_distination.$this->image);
    }
}
