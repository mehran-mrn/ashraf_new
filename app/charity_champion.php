<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_champion extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function image()
    {
        return $this->hasOne('App\media', 'category_id')->where('module', '=', 'champion');
    }

    public function projects()
    {
        return $this->belongsToMany('App\building_project','charity_champions_projects','champion_id','project_id')->with('media','gallery');
    }

    public function transaction()
    {
        return $this->hasMany('App\champion_transaction','champion_id','id');
    }

}
