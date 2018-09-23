<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $connection = 'mysql';
    protected $fillable=[
        'name',
        'code',
    ];

    /**
    * Relations
    */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
