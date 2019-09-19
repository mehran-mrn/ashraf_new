<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_champion extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function image()
    {
        return $this->hasOne('App\media', 'category_id')->where('module', '=', 'champion');
    }

}
