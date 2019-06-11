<?php

namespace App\Http\Controllers\panel;

use App\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class blog extends Controller
{
    //

    public function category_add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:categories',
        ]);
        category::create([
            'title'=>$request->title
        ]);
        $message =trans("messages.item_created",['item'=>trans('messages.category')]);
        return back_normal($request,$message);
    }
}
