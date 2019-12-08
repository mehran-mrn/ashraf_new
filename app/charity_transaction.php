<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_transaction extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;


    public function values()
    {
        return $this->hasMany('App\charity_transactions_value', 'trans_id', 'id')->with('charity_field');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->with('people');
    }

    public function patern()
    {
        return $this->hasOne('App\charity_payment_patern', 'id', 'charity_id');
    }

    public function tranInfo()
    {
        return $this->hasMany('App\gateway_transaction', 'module_id', 'id')->
        where('module', '=', 'charity_donate')->orWhere
        ('module', '=', 'charity_vow');
    }
    public function gateway()
    {
        return $this->hasOne('App\gateway', 'id', 'gateway_id');
    }


    public function title()
    {
        return $this->hasOne('App\charity_payment_title', 'id', 'title_id');
    }
}
