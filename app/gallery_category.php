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


    public function media_one()
    {
        return $this->hasOne('App\media', 'id', 'media_id_one');
    }

    public function media_two()
    {
        return $this->hasOne('App\media', 'id', 'media_id_two');
    }

    public function media_three()
    {
        return $this->hasOne('App\media', 'id', 'media_id_three');
    }
}
