<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class video_gallery extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    //
}
