<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    //

    protected $guarded=[];

    public function blog_categories()
    {
        return $this->hasMany('App\blog_categories','blog_id');
    }
}
