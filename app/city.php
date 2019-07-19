<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $table = 'cities';

    public function province()
    {
        return $this->belongsTo('App\city', 'parent');
    }

    public function city()
    {
        return $this->hasMany('App\city', 'parent');
    }

    public function setting_transportation() {
        return $this->belongsToMany('App\setting_transportation', 'setting_transportation_costs','c_id','t_id')->withPivot('cost');
    }

}
