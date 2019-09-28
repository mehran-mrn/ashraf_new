<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contact extends Model
{
    //
    use SoftDeletes;
    protected $fillable=['name','email','phone','subject','message','status'];
}
