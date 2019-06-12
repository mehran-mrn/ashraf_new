<?php

namespace App\Http\Controllers\panel;

use App\caravan_host;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class caravan extends Controller
{

    public function host_data(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:caravan_hosts,name' . (isset($request['host_id']) ? ',' . $request['host_id'] : ""),
            'city' => 'required',
        ]);
        $host = null;

        if ($request['host_id']) {
            $host = caravan_host::with('media')->find($request['host_id']);
            $image_id = $host['media']['id'];
        }

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            ]);
            if ($host and $host['media']) {
                $image_id = image_saver($request['image'], 'caravan', 'caravan', [], $host['meida']['name']);

            } else {
                $image_id = image_saver($request['image'], 'caravan', 'caravan');
            }
        }
        if ($host) {
            $caravan_host = caravan_host::find($host['id']);
            $caravan_host->name = $request->name;
            $caravan_host->city_name = $request->city;
            $caravan_host->capacity = ($request->capacity ? $request->capacity : null);
            $caravan_host->gender = ($request->gender ? $request->gender : null);
            $caravan_host->media_id = $image_id;
            $caravan_host->save();
        } else {
            caravan_host::create([
                'name' => $request->name,
                'city_name' => $request->city,
                'capacity' => ($request->capacity ? $request->capacity : null),
                'gender' => ($request->gender ? $request->gender : null),
                'media_id' => $image_id
            ]);
        }
        $message = trans("messages.item_created", ['item' => trans('messages.host')]);
        return back_normal($request, $message);
    }

    public function delete_caravan_host($host_id ,Request $request){
        $host = caravan_host::find($host_id);
        $host->delete();
        $messages = trans('messages.item_deleted',['item'=>trans('messages.host')]);
        return back_normal($request,$messages);
    }

    public function caravan_data(Request $request){
        $this->validate($request, [
            'capacity' => 'required',
            'user_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'budget' => 'required',
            'transport' => 'required',
            'start' => 'required',
            'arrival' => 'required',
            'departure' => 'required',
            'end' => 'required',
        ]);


    }


}
