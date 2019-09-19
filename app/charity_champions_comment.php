<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_champions_comment extends Model
{
    //
    use SoftDeletes;
    protected $guarded=[];
}
