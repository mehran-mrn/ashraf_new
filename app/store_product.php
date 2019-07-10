<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_product extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;

    public function store_category()
    {
        return $this->belongsToMany('App\store_category','store_product_categories','product_id','category_id');
    }

    public function store_product_item()
    {
        return $this->belongsToMany('App\store_item','store_product_items','product_id','item_id');
    }

    public function store_product_item2()
    {
        return $this->hasMany('App\store_product_item','product_id');
    }


    public function store_product_category()
    {
        return $this->hasMany('App\store_product_category','product_id');
    }
    public function store_product_gateway()
    {
        return $this->hasMany('App\store_product_gateway','product_id');
    }
    public function store_product_image()
    {
        return $this->hasMany('App\store_product_image','product_id');
    }

    public function store_product_tag()
    {
        return $this->hasMany('App\store_product_tag','product_id');
    }
    public function deleteAll()
    {
        $this->store_product_category()->delete();
        $this->store_product_gateway()->delete();
        $this->store_product_image()->delete();
        $this->store_product_item()->delete();
        $this->store_product_tag()->delete();
        return parent::delete();
    }
}
