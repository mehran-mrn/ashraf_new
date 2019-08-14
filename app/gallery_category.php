<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gallery_category extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function media()
    {
        return $this->hasMany('App\media', 'category_id', 'id');
    }
}
