<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
    public function items()
    {
        return $this->hasMany('App\orders_item','order_id','id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function people()
    {
        return $this->hasOne('App\person', 'user_id', 'user_id');
    }

    public function gateway()
    {
        return $this->hasOne('App\gateway','id','gateway_id');
    }

    public function address()
    {
        return $this->hasOne('App\users_address','id','address_id');

    }

}
