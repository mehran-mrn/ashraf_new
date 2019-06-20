<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_category extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];
}
