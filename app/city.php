<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class city extends Model
{
    protected $table = 'cities';
    protected $fillable = array('name', 'parent','lvl', 'status');

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
    public function all_cities_id()
    {
        return $this->city()->with('city');
    }

    public function province_project()
    {
        return $this->hasMany('App\building_project', 'city_id');
    }
    public function sub_province_project()
    {
        return $this->hasMany('App\building_project', 'city_id_2');
    }
    public function city_project()
    {
        return $this->hasMany('App\building_project', 'city_id_3');
    }

    public function setting_transportation() {
        return $this->belongsToMany('App\setting_transportation', 'setting_transportation_costs','c_id','t_id')->withPivot('cost');
    }

}
