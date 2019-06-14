<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    //

    protected $guarded=[];
    protected $softDelete;

    public function blog_categories()
    {
        return $this->hasMany('App\blog_categories','blog_id');
    }

    public function blog_tag(){
        return $this->hasMany('App\blog_tag','blog_id');
    }

    public function deleteAll(){
        $this->blog_tag()->delete();
        $this->blog_categories()->delete();
        return parent::delete();
    }
}
