<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caravan extends Model
{
    //
    public function host()
    {
        return $this->belongsTo('App\caravan_host','caravan_host_id');
    }
    public function workflow()
    {
        return $this->hasMany('App\caravan_workflow','caravan_id');
    }

    public function persons()
    {
        return $this->hasMany('App\person_caravan','caravan_id');
    }
}
