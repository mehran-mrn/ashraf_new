<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    public function province()
    {
        return $this->belongsTo('App\city','parent');
    }
    public function city()
    {
        return $this->hasMany('App\city','parent');
    }
}
