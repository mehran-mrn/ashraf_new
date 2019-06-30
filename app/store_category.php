<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_category extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];

    public function childs() {
        return $this->hasMany('App\store_category','parent_id','id') ;
    }

    public function store_product()
    {
        return $this->belongsToMany('App\store_product','store_product_categories','category_id','product_id');
    }
}
