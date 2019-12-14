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
}
