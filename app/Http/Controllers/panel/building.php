<?php

namespace App\Http\Controllers\panel;

use App\building_item;
use App\building_project;
use App\building_ticket;
use App\building_ticket_file;
use App\building_ticket_history;
use App\building_ticket_note;
use App\building_ticket_user;
use App\building_type;
use App\building_type_itme;
use App\building_user;
use App\city;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class building extends Controller
{
    //
    public function submit_project_type_data(Request $request)
    {
        $this->validate($request, [
            'project_type_title' => 'required|max:150',
        ]);
        $building_type = null;

        if ($request['building_type_id']) {
            $building_type = building_type::with('media')->find($request['building_type_id']);
        }

        if ($building_type) {
            $the_building_type = building_type::find($building_type['id']);
            $the_building_type->title = $request->project_type_title;
            $the_building_type->media_id = 0;
            $the_building_type->save();
        } else {
            building_type::create([
                'title' => $request->project_type_title,
                'media_id' => "0"
            ]);
        }
        $message = trans("messages.item_created", ['item' => trans('messages.building_type')]);
        return back_normal($request, $message);


    }

    public function get_city_select_option(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $cities = city::where('parent',$request['id'])->get();
        return view('panel.building.materials.city_select_option', compact('cities'));

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

    public function submit_project_data(Request $request)
    {
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
            'province_id' => 'required|exists:cities,id',
            'city_id_2' => 'required|exists:cities,id',
            'city_id_3' => 'required|exists:cities,id',
            'address' => 'required|max:2150',
            'lat' => ['required', 'regex:/' . $regex_lat_long . '/'],
            'long' => ['required', 'regex:/' . $regex_lat_long . '/'],
        ]);
        $start_date = $request['start_date'] ? shamsi_to_miladi($request['start_date']) : null;
        $end_date = $request['end_date'] ? shamsi_to_miladi($request['end_date']) : null;
        $building_project = null;
        $image_id = 0;
        if ($request['project_id']) {
            $building_project = building_project::with('media')->find($request['project_id']);
            $image_id = $building_project['media']['id'];
        }
        if ($request->hasFile('image')) {

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
            $the_project->city_id = $request['province_id'];
            $the_project->city_id_2 = $request['city_id_2'];
            $the_project->city_id_3 = $request['city_id_3'];
            $the_project->province_id = $request['province_id'];
            $the_project->media_id = $image_id;
            $the_project->project_type_id = $request['project_type'];
            $the_project->save();
        } else {
            $the_project = new building_project();
            $the_project->title = $request['project_title'];
            $the_project->description = $request['description'];
            $the_project->lat = $request['lat'];
            $the_project->long = $request['long'];
            $the_project->address = $request['address'];
            $the_project->start_date = $start_date;
            $the_project->end_date_prediction = $end_date;
            $the_project->city_id = $request['province_id'];
            $the_project->city_id_2 = $request['city_id_2'];
            $the_project->city_id_3 = $request['city_id_3'];
            $the_project->province_id = $request['province_id'];
            $the_project->media_id = $image_id;
            $the_project->project_type_id = $request['project_type'];
            $the_project->save();
        }
        $import_building_type_items = [];
        $temp_building_type_items = [];
        $project_type = building_type::with('building_type_items')->find($request['project_type']);
        foreach ($project_type['building_type_items'] as $building_type_item) {
            $temp_building_type_items['title'] = $building_type_item['title'];
            $temp_building_type_items['description'] = $building_type_item['description'];
            $temp_building_type_items['percent'] = $building_type_item['percent'];
            $temp_building_type_items['building_id'] = $the_project['id'];
            $temp_building_type_items['building_type_id'] = $building_type_item['building_type_id'];
            $temp_building_type_items['item_id'] = $building_type_item['id'];
            $temp_building_type_items['parent_id'] = $building_type_item['parent_id'];
            $temp_building_type_items['sort'] = $building_type_item['sort'];
            array_push($import_building_type_items, $temp_building_type_items);
        }
        building_item::insert($import_building_type_items);

        return back_normal($request);

    }

    public function submit_building_type_item(Request $request)
    {
        $this->validate($request, [
            'type_id' => 'required|exists:building_types,id',
            'title' => 'required|max:150',
            'percent' => 'nullable|digits_between:1,100',
        ]);

        $building_type = building_type::with('building_type_items')->find($request['type_id']);
        $percent = 0;
        foreach ($building_type['building_type_items'] as $building_type_item) {
            $percent += $building_type_item['percent'];
        }

        if ($request['type_item_id']) {
            $the_building_type_item = building_type_itme::find($request['type_item_id']);
            $percent -= $the_building_type_item['percent'];
        }
        if ($percent + $request['percent'] > 100) {
            $errors[] = trans('errors.percent_more_than_100');
            return back_error($request, $errors);
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

    public function edit_project_items($project_id, Request $request)
    {
            $this->validate($request, [
                'project_id' => 'required|exists:building_projects,id',
            ]);
        if ($project_id != $request['project_id']) {
            $errors[] = "undefined";
            return back_error($request, $errors);
        }
        $percent = 0;
        if ($request['percent']){
            foreach ($request['percent'] as $item_percent) {
                if ($item_percent > 100 or $item_percent < 0) {
                    $errors[] = trans('errors.percent_more_than_100') . " - " . $item_percent;
                    return back_error($request, $errors);
                }
                $percent += $item_percent;
            }
        }
        if (isset($request['new_item_percent']) and count($request['new_item_percent']) > 0) {
            foreach ($request['new_item_percent'] as $new_item_percent) {
                if ($new_item_percent > 100 or $new_item_percent < 0) {
                    $errors[] = trans('errors.percent_more_than_100') . " - " . $new_item_percent;
                    return back_error($request, $errors);
                }
                $percent += $new_item_percent;
            }
        }
        if ($percent > 100 or $percent < 0) {
            $errors[] = trans('errors.percent_more_than_100') . " - " . $percent;
            return back_error($request, $errors);
        }
        if ($request['item_id']){
        foreach ($request['item_id'] as $old_item_id) {
            $old_building_item = building_item::where('building_id', $project_id)->find($old_item_id);
            $old_building_item['title'] = $request['title'][$old_item_id];
            $old_building_item['percent'] = $request['percent'][$old_item_id];
            $old_building_item->save();
        }}
        if (isset($request['new_item_percent']) and count($request['new_item_percent']) > 0) {
            foreach ($request['new_item_percent'] as $key => $new_item_percent) {
                $new_building_item = new building_item();
                $new_building_item['title'] = $request['new_item_title'][$key];
                $new_building_item['percent'] = $new_item_percent;
                $new_building_item['building_id'] = $project_id;
                $new_building_item->save();
            }
        }
        $message = trans('messages.done');
        return back_normal($request, $message);


    }

    public function delete_project_item($project_id, $item_id, Request $request)
    {
        $item = building_item::where('building_id', $project_id)->find($item_id);
        $has_ticket = building_ticket::where('item_id', $item_id)->exists();
        if ($has_ticket) {
            $errors[] = trans('errors.cant_delete_item');
            return back_error($request, $errors);
        }
        $item->delete();
        $messages = trans('messages.item_deleted', ['item' => trans('messages.item')]);
        return back_normal($request, $messages);
    }

    public function new_ticket($project_id, Request $request)
    {
        $currentUser = Auth::user();
        $now_time = date("Y-m-d H:i:s");
        $this->validate($request, [
            'ticket_title' => 'required',
            'description' => 'required',
            'project_id' => 'required',
            'ticket_type' => 'required',
            'priority' => 'required',
        ]);
        $item_id = null;
        $progress = null;
        if ($request['ticket_type'] == "0") {
            $this->validate($request, [
                'item_id' => 'required',
                'progress_percent' => 'required|digits_between:1,100',
            ]);
            $item_id = latin_num($request['item_id']);
            $progress = latin_num($request['progress_percent']);
        }

        $building_ticket = new building_ticket();
        $building_ticket->title = $request['ticket_title'];
        $building_ticket->predict_percent = $progress;
        $building_ticket->creator = $currentUser['id'];
        $building_ticket->building_id = $request['project_id'];
        $building_ticket->priority = $request['priority'];
        $building_ticket->ticket_type = $request['ticket_type'];
        $building_ticket->item_id = $item_id;
        $building_ticket->save();

        $building_ticket_note = $this->set_ticket_note($request['description'],$building_ticket['id']);
        $this->set_ticket_history($currentUser['id'],$now_time,$building_ticket['id'],$building_ticket_note['id']);

        if (isset($request['doc_id'])) {
            foreach ($request['doc_id'] as $doc_id) {
                $this->set_ticket_file($building_ticket_note['id'],$doc_id);
            }
        }
        $this->set_ticket_user($building_ticket['id'],$currentUser['id']);


        return redirect()->route('building_project', ['project_id' => $project_id]);
    }


    public function add_ticket_note($ticket_id, Request $request)
    {
        $currentUser = Auth::user();
        $now_time = date("Y-m-d H:i:s");
        $this->validate($request, [
            'description' => 'required',
            'ticket_id' => 'required',
        ]);
        if ($request['ticket_id'] != $ticket_id) {
            $errors[] = 'oppss';
            return back_error($request, $errors);
        }
        $item_id = null;
        $progress = null;

        $building_ticket = building_ticket::find($ticket_id);

        $building_ticket_note = $this->set_ticket_note($request['description'],$building_ticket['id']);


        $this->set_ticket_history($currentUser['id'],$now_time,$building_ticket['id'],$building_ticket_note['id']);
        if (!empty($request['doc_id'])) {
            foreach ($request['doc_id'] as $doc_id) {
                $this->set_ticket_file($building_ticket_note['id'],$doc_id);
            }
        }

        return redirect()->route('ticket_page', ['ticket_id' => $ticket_id]);
    }

    public function edit_project_users($project_id, Request $request)
    {
        $this->validate($request, [
            'project_id' => 'required|exists:building_projects,id',
        ]);
        if ($project_id != $request['project_id']) {
            $errors[] = "undefined";
            return back_error($request, $errors);
        }
        building_user::where('building_id', $project_id)->delete();
        $users = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request['users_id_' . $i]) {
                foreach ($request['users_id_' . $i] as $user) {
                    if (!in_array($user, $users)) {
                        $users[] = $user;
                        $building_user = new building_user();
                        $building_user['user_id'] = $user;
                        $building_user['building_id'] = $project_id;
                        $building_user['level'] = $i;
                        $building_user->save();
                    }
                }
            }
        }
        $message = trans('messages.done');
        return back_normal($request, $message);


    }

    public function close_building_ticket($ticket_id, Request $request)
    {
        $currentUser = Auth::user();
        $now_time = date("Y-m-d H:i:s");

        $this->validate($request, [
            'ticket_id' => 'required|exists:building_tickets,id',
        ]);
        if ($ticket_id != $request['ticket_id']) {
            $errors[] = "undefined";
            return back_error($request, $errors);
        }
        $ticket = building_ticket::find($ticket_id);
        if ($ticket['closed']){
            $ticket->actual_percent = null;
            $ticket->closed = null;
            $ticket->save();

            $building_ticket_history = new building_ticket_history();
            $building_ticket_history->user_id = $currentUser['id'];
            $building_ticket_history->time = $now_time;
            $building_ticket_history->building_ticket_id = $ticket['id'];
            $building_ticket_history->history_type = 7; //7= re open
            $building_ticket_history->save();
        }
        else {
            if ($ticket['ticket_type'] == 0) {
                $this->validate($request, [
                    'actual_percent' => 'required|numeric|min:0|max:100',
                ]);
                $old_tickets = building_ticket::where('item_id', $ticket['item_id'])
                    ->where('building_id', $ticket['building_id'])
                    ->where('actual_percent', '>', '0')->get();
                $total_percent = 0;
                foreach ($old_tickets as $old_ticket) {
                    $total_percent += $old_ticket['actual_percent'];
                }
                if (($total_percent + $request['actual_percent']) > 100) {
                    $errors[] = trans('errors.percent_more_than_100');
                    return back_error($request, $errors);
                }
                $ticket->actual_percent = $request['actual_percent'];
            }
            $ticket->closed = $now_time;
            $ticket->save();

            $building_ticket_history = new building_ticket_history();
            $building_ticket_history->user_id = $currentUser['id'];
            $building_ticket_history->time = $now_time;
            $building_ticket_history->building_ticket_id = $ticket['id'];
            $building_ticket_history->history_type = 4; //4= close ticket
            $building_ticket_history->save();
        }
        $message = trans('messages.done');
        return back_normal($request, $message);


    }

    public function upload_files(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|max:10240',
        ]);
        $doc_id = private_file_saver($request['file'],'buildings','z','z');
        return $doc_id;
    }

    public function follow_project(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
        ]);

        $building_user = building_user::where('user_id',Auth::id())->where('building_id',$request['id'])->first();
        if (!$building_user){
            $building_user = new building_user();
            $building_user->user_id = Auth::id();
            $building_user->building_id = $request['id'];
            $building_user->follow = true;
        }
        else{
            $building_user->follow = ($building_user->follow? false:true);
        }
        $building_user->save();

        return back();
    }

    public function submit_project_end(Request $request)
    {
        $regex_date = "([1][3,4]\d{2}['\-'|'\/'](0[1-9]|[1-9]|1[0-2])['\-'|'\/'](0[1-9]|[12]\d|3[01]|\d))";
        $this->validate($request, [
            'id' => 'required',
            'actual_end_date' => ['required'],
        ]);

        $building = building_project::find($request['id']);
        $building->end_date_actual = shamsi_to_miladi($request['actual_end_date']);
        $building->archived = true;
        $building->save();
        return back();
    }

    public function submit_project_reopen(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $building = building_project::find($request['id']);
        $building->archived = false;
        $building->save();
        return back();
    }

    private function set_ticket_note($description,$building_ticket_id){
        $building_ticket_note = new building_ticket_note();
        $building_ticket_note->description = $description;
        $building_ticket_note->building_ticket_id = $building_ticket_id;
        $building_ticket_note->save();
        return $building_ticket_note;
    }
    private function set_ticket_history($user_id,$time,$building_ticket_id,$building_ticket_note_id){
        $building_ticket_history = new building_ticket_history();
        $building_ticket_history->user_id = $user_id;
        $building_ticket_history->time = $time;
        $building_ticket_history->building_ticket_id = $building_ticket_id;
        $building_ticket_history->building_ticket_note_id = $building_ticket_note_id;
        $building_ticket_history->save();
        return $building_ticket_history;
    }
    private function set_ticket_file($building_ticket_note_id,$doc_id){
        $building_ticket_file = new building_ticket_file();
        $building_ticket_file->building_ticket_note_id = $building_ticket_note_id;
        $building_ticket_file->doc_id = $doc_id;
        $building_ticket_file->save();
        return $building_ticket_file;
    }
    private function set_ticket_user($ticket_id,$user_id){
        $building_ticket_user = new building_ticket_user();
        $building_ticket_user->ticket_id = $ticket_id;
        $building_ticket_user->user_id = $user_id;
        $building_ticket_user->save();
        return $building_ticket_user;
    }
}
