<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = [
        'name' ,'merchant_id' ,'governorate_id'
    ];

    /**
     * Relations
     */
     public function merchant()
     {
         return $this->belongsTo(Merchant::class);
     }
     public function governorate()
     {
         return $this->belongsTo(Governorate::class);
     }
}
