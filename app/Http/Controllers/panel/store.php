<?php

namespace App\Http\Controllers\panel;

use App\discount_code;
use App\Http\Controllers\Controller;
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
         if(discount_code::where('code',$request['discount_code'])->exists()){
             echo "true";
         }else{
             echo "false";
         }
    }
}
