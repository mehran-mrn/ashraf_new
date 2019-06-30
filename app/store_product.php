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

    public function store_product_category()
    {
        return $this->hasMany('App\store_procudt_category','product_id');
    }
    public function deleteAll()
    {
        $this->store_category()->delete();
        return parent::delete();
    }
}
