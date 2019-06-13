<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caravan_workflow extends Model
{
    //
    public function caravan()
    {
        return $this->belongsTo('App\caravan','caravan_id');
    }
}
