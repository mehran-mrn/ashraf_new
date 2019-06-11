<?php

namespace App\Http\Controllers\panel;

use App\caravan_host;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class caravan extends Controller
{

    public function host_data(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:caravan_hosts',
            'city' => 'required',
        ]);
        $image_id=1;
        if ($request->hasFile('image')){
            back_normal($request);
            $this->validate($request, [
                'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            ]);
            $image_id = image_saver($request['image'],'caravan','caravan');
        }

        caravan_host::create([
            'name' => $request->name ,
            'city_name' => $request->city ,
            'capacity' => ($request->capacity ? $request->capacity : null ),
            'gender' => ($request->gender ? $request->gender:null),
            'image' => $image_id
        ]);
        $message =trans("messages.item_created",['item'=>trans('messages.host')]);
        return back_normal($request,$message);
    }

}
