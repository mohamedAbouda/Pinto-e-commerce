<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateDeal extends Model
{
    protected $table = 'corporate_deals';
    protected $fillable = ['first_product_id','second_product_id','discount','merchant_id','approved'];

    public function firstProduct()
    {
        return $this->belongsTo('App\Models\Product','first_product_id');
    }

    public function secondProduct()
    {
        return $this->belongsTo('App\Models\Product','second_product_id');
    }

    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }
}
