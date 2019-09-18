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
    public function gallery()
    {
        return $this->hasMany('App\media', 'category_id', 'id')->where('media.module', '=', 'building');
    }

    public function building_items()
    {
        return $this->hasMany('App\building_item','building_id');
    }
    public function building_users()
    {
        return $this->hasMany('App\building_user','building_id');
    }
    public function city(){
        return $this->belongsTo('App\city','city_id');
    }
}
