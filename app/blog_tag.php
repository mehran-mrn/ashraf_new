<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog_tag extends Model
{
    //
    protected $guarded=[];
    protected $softDelete;


    public function blog(){
        return $this->belongsTo('App\blog','blog_id');
    }
}
