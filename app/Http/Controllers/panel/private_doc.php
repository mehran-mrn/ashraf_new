<?php

namespace App\Http\Controllers\panel;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\media;

class private_doc extends Controller
{
    public function show($media_id)
    {
        $image = media::find($media_id);
        $storagePath = $image['url'];
        return Image::make($storagePath)->response();
    }
}
