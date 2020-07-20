<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function reply()
	{
		return $this->hasMany('App\ReviewReply');
	}
	public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}
	public function reported()
	{
		return $this->hasMany('App\ReportedReview');
	}
}
