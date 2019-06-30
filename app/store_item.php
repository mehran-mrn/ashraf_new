<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_item extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];


    public function store_item_category()
    {
        return $this->hasOne('App\store_item_category','id','category_id');
    }
}
