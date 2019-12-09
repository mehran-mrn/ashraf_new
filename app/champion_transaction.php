<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class champion_transaction extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function champion()
    {
        return $this->hasOne('App\charity_champion', 'id','champion_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }

    public function tranInfo()
    {
        return $this->hasMany('App\gateway_transaction', 'module_id','id')->where('module','charity_champion');
    }

    public function gateway()
    {
        return $this->hasOne('App\gateway', 'id','gateway_id');
    }
}
