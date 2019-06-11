<?php

namespace App\Http\Controllers\panel;

use App\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class blog extends Controller
{
    //

    public function category_add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:categories',
        ]);
        category::create([
            'title' => $request->title
        ]);
        $message = trans("messages.item_created", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }

    public function add_post_store(Request $request)
    {
        media_proses($request,"blog","blog",['500,500','600,250']);
    }



}
