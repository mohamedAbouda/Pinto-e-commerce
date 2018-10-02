<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $connection = 'mysql';
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
