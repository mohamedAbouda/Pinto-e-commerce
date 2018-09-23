<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'name' ,'governorate_id'
    ];

    /**
     * Relations
     */
     public function governorate()
     {
         return $this->belongsTo(Governorate::class);
     }
}
