<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_type_itme extends Model
{
    //
    public function building_type()
    {
        return $this->belongsTo('App\building_type','building_type_id');
    }
}
