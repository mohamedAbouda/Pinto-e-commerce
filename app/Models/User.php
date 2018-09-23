<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Http\UploadedFile;

class User extends Authenticatable
{
    protected $connection = 'mysql';
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'national_id',
        'start_date',
        'phone',
        'social_id',
        'social_type',
        'profile_pic',
        'valid',
    ];

    protected $appends = ['profile_pic_url','national_id_url'];
    public $upload_distination = '/uploads/images/users/';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    

 
    public function orders()
    {
        return $this->hasMany(Order::class);
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

        public function setNationalIdAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['national_id'] = '';
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['national_id'] = $image_name;
    }

    public function getNationalIdUrlAttribute()
    {
        return $this->national_id ? asset('public/'.$this->upload_distination.$this->national_id) : '';
    }


}
