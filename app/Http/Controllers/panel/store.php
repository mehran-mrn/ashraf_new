<?php

namespace App\Http\Controllers\panel;

use App\discount_code;
use App\Http\Controllers\Controller;
use App\product_category;
use Illuminate\Http\Request;

class store extends Controller
{
    //

    public function discount_add(Request $request)
    {
        dd($request->all());
    }

    public function check_discount_code(Request $request)
    {
        if (discount_code::where('code', $request['discount_code'])->exists()) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function product_category_add(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:2|unique:product_categories,title',
                'filepath' => 'required',
            ]);
        product_category::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'icon_id' => get_file_id($request['filepath']),
            'icon' => $request['filepath'],
        ]);
        $message = trans("messages.category_added");
        return back_normal($request, $message);
    }
}
