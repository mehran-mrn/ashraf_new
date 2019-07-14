<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_item extends Model
{
    //
    public function building_project()
    {
        return $this->belongsTo('App\building_project','building_id');
    }
}
