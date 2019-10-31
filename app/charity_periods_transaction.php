<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_periods_transaction extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];

    public function period()
    {
        return $this->hasOne('App\charity_period','id','period_id')->with('user');
    }

    public function admin()
    {
        return $this->hasOne('App\User','id','review_user_id');
    }

    public function gateway()
    {
        return $this->hasOne('App\gateway','id','gateway_id');
    }
    public function user()
    {
        return $this->hasOne('App\User','id','user_id')->with('people');
    }

    public function tranInfo()
    {
        return $this->hasMany('App\gateway_transaction', 'module_id', 'id')->
        where('module', '=', 'charity_period');
    }
}
