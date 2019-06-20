<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_discount_code extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];
}
