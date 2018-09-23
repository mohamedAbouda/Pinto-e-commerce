<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;


class Merchant extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name','email','phone','profile_pic','cover_pic','bio','address_id','approved','type'
        ,'hot_line','mobile','created_by','corporate_deal_check'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function merchantAdmins()
    {
        return $this->hasMany(MerchantAdmin::class ,'merchant_id');
    }

    protected $appends = ['cover_pic_url','profile_pic_url'];
    public $upload_distination = '/uploads/images/merchants/';



    public function setCoverPicAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['cover_pic'] = '';
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['cover_pic'] = $image_name;
    }

    public function getCoverPicUrlAttribute()
    {
        return $this->cover_pic ? asset('public/'.$this->upload_distination.$this->cover_pic) : '';
    }

    public function setProfilePicAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['profile_pic'] = '';
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['profile_pic'] = $image_name;
    }

    public function getProfilePicUrlAttribute()
    {
        return $this->profile_pic ? asset('public/'.$this->upload_distination.$this->profile_pic) : '';
    }
}
