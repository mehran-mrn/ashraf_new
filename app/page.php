<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    protected $fillable = array('local','name','slug', 'content','url', 'index');



    public static function get_page($slug,$local) {
        $page = page::where('slug',$slug)
            ->where('link',true)
            ->where('local',$local)
            ->first();
        return $page;
    }

    public static function index_page($local) {
        $page = page::where('local',$local)
            ->where('index',1)
            ->first();
        return $page;
    }


}
