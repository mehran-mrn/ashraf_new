<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class city extends Model
{
    protected $table = 'cities';
    protected $fillable = array('name', 'parent', 'status');

    use SoftDeletes;

    public function province()
    {
        return $this->belongsTo('App\city', 'parent');
    }
    public function all_provinces()
    {
        return $this->province()->with('all_provinces');
    }

    public function city()
    {
        return $this->hasMany('App\city', 'parent');
    }

    public function all_cities()
    {
        return $this->city()->with('city');
    }


    public function setting_transportation() {
        return $this->belongsToMany('App\setting_transportation', 'setting_transportation_costs','c_id','t_id')->withPivot('cost');
    }

}
