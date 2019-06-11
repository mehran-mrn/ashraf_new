<?php

namespace App\Http\Controllers\panel;

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
        if ($request['image']){
            $this->validate($request, [
                'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            ]);
        }
        $image = $request->file('image');
        $destinationPath = 'public/images';
        $thumbnailPath = 'public/images/thumbnail';
        $image_name = mt_rand() . time().'.'.$image->getClientOriginalExtension();
        if ($currentUser->avatar) {
            $image_name = $currentUser->avatar;
        }
        $img =  Image::make($image->getRealPath());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath.'/'.$image_name);
        $image->move($destinationPath, $image_name);
        $currentUser->avatar= $image_name;
        $currentUser->last_modifier= $currentUser->id;
        $currentUser->save();







        Permission::create([
            'name' => $request->key ,
            'display_name' => $request->display_name ,
            'category' => $request->category ,
            'description' =>  $request->description ,
        ]);
        $message =trans("messages.item_created",['item'=>trans('messages.permission')]);
        return back_normal($request,$message);
    }

}
