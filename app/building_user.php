<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_user extends Model
{
    //
    public function building_project()
    {
        return $this->belongsTo('App\building_project','building_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
