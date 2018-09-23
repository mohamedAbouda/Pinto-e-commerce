<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sub_categories';

    protected $fillable = [
        'name',
        'icon',
        'color',
        'category_id',
        'tags',
    ];
    /**
    * Relations
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
