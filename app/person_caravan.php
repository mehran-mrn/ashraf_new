<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class person_caravan extends Model
{
    //
    public function person()
    {
        return $this->belongsTo('App\person','person_id');
    }

    public function parent(){

        return $this->belongsTo('App\person_caravan','parent_id');

    }
    public function caravan()
    {
        return $this->belongsTo('App\caravan','caravan_id');
    }
}
