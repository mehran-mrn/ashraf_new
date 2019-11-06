<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    public function subMenu()
    {
        return $this->hasMany('App\menu','parent_id');
    }
}
