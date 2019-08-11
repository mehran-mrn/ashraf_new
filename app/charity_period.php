<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_period extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];
}
