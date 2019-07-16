<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class setting_transportation_cost extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
}
