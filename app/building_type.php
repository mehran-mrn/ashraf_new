<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_type extends Model
{
    protected $fillable = [
        'title','media_id'
    ];
    //
    public function building_type_items(){
        return $this->hasMany('App\building_type_itme','building_type_id');
    }
    public function media()
    {
        return $this->belongsTo('App\media','media_id');
    }
}
