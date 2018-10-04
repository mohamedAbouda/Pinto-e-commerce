<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;

class Client extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_id',
        'social_type',
        'profile_pic',
        'phone',
        'address_id',
        'valid',
        'api_token',
    ];

    protected $appends = ['profile_pic_url'];
    public $upload_distination = '/uploads/images/clients/';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
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

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function addresses()
    {
        return $this->belongsToMany('App\Models\Address');
    }

      public function wishlists()
    {
        return $this->hasMany('App\Models\WishList');
    }

   


}
