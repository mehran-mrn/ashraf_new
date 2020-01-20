<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class users_address extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;


    public function extraInfo()
    {
        return $this->hasOne('App\users_address_extra_info','address_id','id');
    }

    public function city()
    {
        return $this->hasOne('App\city','id','city_id');
    }

    public function province()
    {
        return $this->hasOne('App\city','id','province_id');
    }
}
