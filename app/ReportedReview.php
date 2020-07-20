<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportedReview extends Model
{
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
	public function review()
	{
		return $this->belongsTo('App\ProductReview', 'product_review_id');
	}
}
