<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;


class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name','description','short_description','technical_specs','cover_image',
        'price','sub_category_id','brand_id','user_id','featured','sku' ,
        'views','key_word_id','approved','match_keys',
        'description_section_1_image' ,'description_section_1_head' ,'description_section_1_text' ,
        'description_section_2_image' ,'description_section_2_head_1' ,'description_section_2_text_1' ,'description_section_2_head_2' ,'description_section_2_text_2' ,'description_section_2_head_3' ,'description_section_2_text_3' ,'description_section_2_head_4' ,'description_section_2_text_4' ,
        'description_section_3_image' ,'description_section_3_head' ,'description_section_3_text'
    ];
    protected $appends = ['cover_image_url' ,'description_section_1_image_url' ,'description_section_2_image_url' ,'description_section_3_image_url' , 'rate'];
    protected $dates = ['created_at' , 'updated_at'];
    public $upload_distination = '/uploads/images/products/';

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

    public function setDescriptionSection1ImageAttribute($value)
    {
        $this->upload('description_section_1_image' ,$value);
    }
    public function setDescriptionSection2ImageAttribute($value)
    {
        $this->upload('description_section_2_image' ,$value);
    }
    public function setDescriptionSection3ImageAttribute($value)
    {
        $this->upload('description_section_3_image' ,$value);
    }
    public function setCoverImageAttribute($value)
    {
        $this->upload('cover_image' ,$value);
    }

    public function getDescriptionSection1ImageUrlAttribute($value)
    {
        return strpos($this->description_section_1_image, 'http') === false ? asset('public/'.$this->upload_distination.$this->description_section_1_image) : $this->description_section_1_image;
    }
    public function getDescriptionSection2ImageUrlAttribute($value)
    {
        return strpos($this->description_section_2_image, 'http') === false ? asset('public/'.$this->upload_distination.$this->description_section_2_image) : $this->description_section_2_image;
    }
    public function getDescriptionSection3ImageUrlAttribute($value)
    {
        return strpos($this->description_section_3_image, 'http') === false ? asset('public/'.$this->upload_distination.$this->description_section_3_image) : $this->description_section_3_image;
    }
    public function getCoverImageUrlAttribute()
    {
        return strpos($this->cover_image, 'http') === false ? asset('public/'.$this->upload_distination.$this->cover_image) : $this->cover_image;
    }

    public function getRateAttribute()
    {
        if ($this->reviews()->count()) {
            return ($this->reviews()->sum('rate') / $this->reviews()->count());
        }
        return 0;
    }

    /**
    * Relations
    */

    public function sizes()
    {
        return $this->belongsToMany('App\Models\Size');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function keyWord()
    {
        return $this->belongsTo('App\Models\KeyWord','key_word_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class ,'product_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class ,'product_id');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function discountCount()
    {
        return $this->hasMany(DiscountProduct::class);
    }

    public function discount()
    {
        return $this->hasOne(DiscountProduct::class ,'product_id');
    }

    public function generalProduct()
    {
        return $this->hasOne('App\Models\GeneralProduct');
    }
}
