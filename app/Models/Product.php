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
        'views','key_word_id','approved','match_keys'
    ];
    protected $appends = ['cover_image_url' , 'rate'];
    protected $dates = ['created_at' , 'updated_at'];
    public $upload_distination = '/uploads/images/products/';

    /**
    * Accessors & Mutators
    */

    public function setCoverImageAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['cover_image'] = $value;
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['cover_image'] = $image_name;
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
