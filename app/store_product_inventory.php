<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store_product_inventory extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
}
