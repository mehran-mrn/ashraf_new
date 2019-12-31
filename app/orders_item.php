<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orders_item extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;

    public function product()
    {
        return $this->hasOne('App\store_product','id','product_id');
    }
}
