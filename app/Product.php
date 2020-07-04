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
}
