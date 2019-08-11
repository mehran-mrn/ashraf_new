<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_periods_transaction extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];
}
