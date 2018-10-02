<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $connection = 'mysql';
    protected $fillable = ['name'];
    /*
    * Relations
    */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
