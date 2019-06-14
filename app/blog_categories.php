<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog_categories extends Model
{
    //
    protected $guarded = [];
    protected $softDelete;

    public function blog()
    {
        return $this->belongsTo('App\blog', 'blog_id');
    }

    public function category()
    {
        return $this->belongsTo('App\category', 'category_id');
    }

}
