<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $fillable = [
        'title', 'status'
    ];


    public function blog_categories()
    {
        return $this->hasMany('App\blog_categories','category_id');
    }
}
