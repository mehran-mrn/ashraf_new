<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gateway_transaction extends Model
{
    //

    public function charity()
    {
        return $this->belongsTo('App\charity_transaction','id','module_id');
    }
}
