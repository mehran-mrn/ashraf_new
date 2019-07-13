<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_product_inventory extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
    public function store_product()
    {
        return $this->hasOne('App\store_product','id','product_id');
    }
}
