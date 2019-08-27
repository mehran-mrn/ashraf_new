<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class users_address extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
}
