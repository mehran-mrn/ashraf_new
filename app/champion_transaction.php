<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class champion_transaction extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function champion()
    {
        return $this->hasOne('App\charity_champion', 'id','champion_id');
    }
}
