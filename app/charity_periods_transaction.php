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
}
