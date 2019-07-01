<?php

namespace App\Http\Controllers\panel;

use App\building_project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class building extends Controller
{
    //
    public function submit_project_data(Request $request){
        $regex_lat_long = "(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$";

        $this->validate($request, [
            'project_title' => 'required|max:150',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'required',
            'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            'project_type' => 'required|exists:building_types,id',
            'province_id' => 'required|exists:cities,id',
            'address' => 'required|max:2150',
            'city_id' => 'required|exists:cities,id',
            'lat' => ['required', 'regex:/' . $regex_lat_long . '/'],
            'long' => ['required', 'regex:/' . $regex_lat_long . '/'],
        ]);

        $new_project = new building_project();
        $new_project->title=$request['project_title'];
        $new_project->description=$request['description'];
        $new_project->lat=$request['lat'];
        $new_project->long=$request['long'];
        $new_project->address=$request['address'];
        $new_project->start_date=$request['start_date'];
        $new_project->end_date_prediction=$request['end_date'];
        $new_project->city_id=$request['city_id'];
        $new_project->province_id=$request['province_id'];
        $new_project->media_id=0;
        $new_project->project_type_id=$request['project_type'];
        $new_project->save();



    }
}
