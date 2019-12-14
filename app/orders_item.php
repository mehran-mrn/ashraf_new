<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orders_item extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
}
