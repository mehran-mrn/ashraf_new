<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_project extends Model
{
    //
    public function media()
    {
        return $this->belongsTo('App\media','media_id');
    }
    public function building_items()
    {
        return $this->hasMany('App\building_item','building_id');
    }

}
