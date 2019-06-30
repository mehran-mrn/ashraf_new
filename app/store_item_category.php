<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_item_category extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];

    public function store_item()
    {
        return $this->hasMany('App\store_item','category_id','id');
    }


    public function deleteAllItems(){
        $this->store_item()->delete();
        return parent::delete();
    }

    public function getChild()
    {
        return $this->store_item()->get();

    }
}
