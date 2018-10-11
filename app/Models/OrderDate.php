<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDate extends Model
{
	protected $table = 'order_dates';
	protected $fillable = ['order_id','date_from','date_to'];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
