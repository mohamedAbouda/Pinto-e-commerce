<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $connection = 'mysql';
    protected $fillable = [
        'title' , 'description' , 'image' , 'banner_text' , 'banner_location'
    ];
    protected $hidden = [
        'created_at' , 'updated_at'
    ];
    protected $appends = ['image_url'];
    protected $_upload_path;

    public function __construct(array $input = []){
        parent::__construct($input);
        $this->_upload_path = 'images/collection';
    }

    /**
    * Accessors & Mutators
    */

    public function getImageUrlAttribute()
    {
        return ($this->image)? url('storage/app/'.$this->image):'';
    }
    public function getBannerTextUrlAttribute()
    {
        return ($this->banner_text)? url('storage/app/'.$this->banner_text):'';
    }

    /**
     * Relations
     */

     public function products()
     {
         return $this->belongsToMany(Product::class , 'collection_product' , 'collection_id' , 'product_id');
     }

    /**
    * Overrides
    */

    public static function create(array $input = [])
    {
        // dd($input);
        $resource = new self($input);

        if ($input['image']) {
            $resource->image  = $input['image']->store($resource->_upload_path);
        }
        if ($input['banner_text']) {
            $resource->banner_text = $input['banner_text']->store($resource->_upload_path.'/banners');
        }

        $saved =  $resource->save();
        return ($saved)?$resource:NULL;
    }
    public function patch(array $input = [])
    {
        if (isset($input['image']) && $input['image']) {
            $path_to_file = storage_path('app/'.$this->image);
            if (file_exists($path_to_file)) {
                unlink($path_to_file);
            }
            $input['image']  = $input['image']->store($this->_upload_path);
        }
        if (isset($input['banner_text']) && $input['banner_text']) {
            $path_to_file = storage_path('app/'.$this->banner_text);
            if (file_exists($path_to_file)) {
                unlink($path_to_file);
            }
            $input['banner_text'] = $input['banner_text']->store($this->_upload_path.'/banners');
        }
        $state = $this->update($input);
        return $state;
    }
}
