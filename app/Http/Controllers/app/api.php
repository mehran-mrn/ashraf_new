<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;

class api extends Controller
{
    //

    public function blogSlider()
    {

        $posts = get_posts(4,['last_post']);

        return response()->json($posts);
    }
    public function blogList()
    {
        return response()->json(['data'=>"List"]);
    }
}
