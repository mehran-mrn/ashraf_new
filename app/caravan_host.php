<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caravan_host extends Model
{
    protected $fillable = [
        'name', 'city_name', 'capacity', 'gender', 'media_id'
    ];

    public function caravan()
    {
        return $this->hasMany('App\caravan','caravan_host_id');
    }

    public function media()
    {
        return $this->belongsTo('App\media','media_id');
    }
}
