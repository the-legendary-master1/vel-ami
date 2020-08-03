<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function shop()
    {
        return $this->belongsTo('App\MyShop', 'my_shop_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function reviews()
    {
        return $this->hasMany('App\ProductReview');
    }
    public function images()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function image()
    {
        return $this->hasOne('App\ProductImage');
    }
}
