<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function my_shop()
    {
        return $this->hasOne('App\MyShop');
    }
    public function chats()
    {
        return $this->hasMany('App\Chat', 'customer_id');
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
