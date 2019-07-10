<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_product_item extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;


    public function store_item()
    {
        return $this->hasMany('App\store_item','item_id');
    }
}
