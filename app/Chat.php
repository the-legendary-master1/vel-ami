<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	public function user()
	{
		return $this->belongsTo('App\User', 'customer_id');
	}
	public function attachments()
	{
		return $this->hasMany('App\ChatAttachment');
	}
	public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}
}
