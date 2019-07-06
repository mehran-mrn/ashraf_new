<?php

namespace App\Http\Controllers\panel;

use App\building_project;
use App\building_type;
use App\building_type_itme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class building extends Controller
{
    //
    public function submit_project_type_data(Request $request){
        $this->validate($request, [
            'project_type_title' => 'required|max:150',
            'image' => 'required_without_all:building_type_id|nullable|bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
        ]);
        $building_type=null;

        if ($request['building_type_id']) {
            $building_type = building_type::with('media')->find($request['building_type_id']);
            $image_id = $building_type['media']['id'];
        }
        if($request->hasFile('image')){

            if ($building_type and $building_type['media']) {
                $image_id = image_saver($request['image'], 'building', 'building', [], $building_type['meida']['name']);

            } else {
                $image_id = image_saver($request['image'], 'building', 'building');
            }
        }


        if ($building_type) {
            $the_building_type = building_type::find($building_type['id']);
            $the_building_type->title = $request->project_type_title;
            $the_building_type->media_id = $image_id;
            $the_building_type->save();
        } else {
            building_type::create([
                'title' => $request->project_type_title,
                'media_id' => $image_id
            ]);
        }
        $message = trans("messages.item_created", ['item' => trans('messages.building_type')]);
        return back_normal($request, $message);


    }

    public function delete_building_type($building_type_id, Request $request)
    {
        $host = building_type::find($building_type_id);
        $host->delete();
        $messages = trans('messages.item_deleted', ['item' => trans('messages.building_type')]);
        return back_normal($request, $messages);
    }
    public function delete_building_type_item($building_type_item_id, Request $request)
    {
        $building_type_itme = building_type_itme::find($building_type_item_id);
        $building_type_itme->delete();
        $messages = trans('messages.item_deleted', ['item' => trans('messages.item')]);
        return back_normal($request, $messages);
    }

    public function submit_project_data(Request $request){
        $regex_lat_long = "(\-?\d+(\.\d+)?)$";
        $regex_date = "([1][3,4]\d{2}['\-'|'\/'](0[1-9]|[1-9]|1[0-2])['\-'|'\/'](0[1-9]|[12]\d|3[01]|\d))";
        $request['start_date'] = latin_num($request['start_date']);
        $request['end_date'] = latin_num($request['end_date']);

        $this->validate($request, [
            'project_title' => 'required|max:150',
            'start_date' => ['required', 'regex:/' . $regex_date . '/'],
            'end_date' => ['regex:/' . $regex_date . '/'],
            'description' => 'required',
            'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            'project_type' => 'required|exists:building_types,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|max:2150',
            'lat' => ['required', 'regex:/' . $regex_lat_long . '/'],
            'long' => ['required', 'regex:/' . $regex_lat_long . '/'],
        ]);
        $start_date = $request['start_date'] ? shamsi_to_miladi($request['start_date']) : null;
        $end_date = $request['end_date'] ? shamsi_to_miladi($request['end_date']) : null;
        $building_project=null;
        $image_id=0;
        if ($request['project_id']) {
            $building_project = building_project::with('media')->find($request['project_id']);
            $image_id = $building_project['media']['id'];
        }
        if($request->hasFile('image')){

            if ($building_project and $building_project['media']) {
                $image_id = image_saver($request['image'], 'building', 'building', [], $building_project['meida']['name']);

            } else {
                $image_id = image_saver($request['image'], 'building', 'building');
            }
        }
        if ($building_project) {
            $the_project = building_project::find($building_project['id']);
            $the_project->title = $request['project_title'];
            $the_project->description = $request['description'];
            $the_project->lat = $request['lat'];
            $the_project->long = $request['long'];
            $the_project->address = $request['address'];
            $the_project->start_date = $start_date;
            $the_project->end_date_prediction = $end_date;
            $the_project->city_id = $request['city_id'];
            $the_project->province_id = $request['province_id'];
            $the_project->media_id = $image_id;
            $the_project->project_type_id = $request['project_type'];
            $the_project->save();
        } else {
            $new_project = new building_project();
            $new_project->title = $request['project_title'];
            $new_project->description = $request['description'];
            $new_project->lat = $request['lat'];
            $new_project->long = $request['long'];
            $new_project->address = $request['address'];
            $new_project->start_date = $start_date;
            $new_project->end_date_prediction = $end_date;
            $new_project->city_id = $request['city_id'];
            $new_project->province_id = $request['province_id'];
            $new_project->media_id = $image_id;
            $new_project->project_type_id = $request['project_type'];
            $new_project->save();
        }
        return back_normal($request);

    }

    public function submit_building_type_item(Request $request){
        $this->validate($request, [
            'type_id' => 'required|exists:building_types,id',
            'title' => 'required|max:150',
            'percent' => 'nullable|digits_between:1,100',
        ]);

        $building_type = building_type::with('building_type_items')->find($request['type_id']);
        $percent = 0;
        foreach ($building_type['building_type_items'] as $building_type_item){
            $percent+= $building_type_item['percent'];
        }

        if ($request['type_item_id']){
            $the_building_type_item = building_type_itme::find($request['type_item_id']);
            $percent-= $the_building_type_item['percent'];
        }
        if ($percent +$request['percent'] >100){
            $errors[]=trans('errors.percent_more_than_100');
            return back_error($request,$errors);
        }
        if ($request['type_item_id']) {
            $the_building_type_item = building_type_itme::find($request['type_item_id']);
            $the_building_type_item->title = $request['title'];
            $the_building_type_item->description = $request['description'];
            $the_building_type_item->percent = $request['percent'];
            $the_building_type_item->save();
        } else {
            $the_building_type_item = new building_type_itme();
            $the_building_type_item->title = $request['title'];
            $the_building_type_item->description = $request['description'];
            $the_building_type_item->percent = $request['percent'];
            $the_building_type_item->building_type_id = $request['type_id'];
            $the_building_type_item->save();

        }
        $message = trans("messages.item_created", ['item' => trans('messages.item')]);

        return back_normal($request, $message);


    }

}
