<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_product_category extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;

}
