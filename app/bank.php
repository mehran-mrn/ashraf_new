<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    //
    protected $guarded=[];

    public function gateway()
    {
        return $this->hasMany('App\gateway');
    }
}
