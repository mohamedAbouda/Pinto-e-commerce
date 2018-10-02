<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = ['address','phone','country','city','lat','lng','country_id','governorate_id'];

    public function clients()
    {
        return $this->belongsToMany('App\Models\Clients');
    }

    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }
}
