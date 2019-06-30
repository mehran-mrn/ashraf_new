<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_product_gateway extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;
}
