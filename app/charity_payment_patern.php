<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class charity_payment_patern extends Model
{
    //

    public function fields()
    {
        return $this->hasMany('App\charity_payment_field','ch_pay_pattern_id');
    }
    public function titles()
    {
        return $this->hasMany('App\charity_payment_title','ch_pay_pattern_id');
    }
}
