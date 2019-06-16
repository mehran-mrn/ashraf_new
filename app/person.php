<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class person extends Model
{
    //
    public function caravan()
    {
        return $this->hasMany('App\caravan','person_id');
    }
}
