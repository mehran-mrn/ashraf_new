<?php

namespace App\Http\Controllers\panel;

use App\caravan_host;
use App\caravan_workflow;
use App\person;
use App\person_caravan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Auth;

class caravan extends Controller
{

    public function host_data(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:caravan_hosts,name' . (isset($request['host_id']) ? ',' . $request['host_id'] : ""),
            'city' => 'required',
            'image' => 'required_without_all:host_id|nullable|bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
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

    public function delete_caravan_host($host_id, Request $request)
    {
        $host = caravan_host::find($host_id);
        $host->delete();
        $messages = trans('messages.item_deleted', ['item' => trans('messages.host')]);
        return back_normal($request, $messages);
    }

    public function caravan_data(Request $request)
    {

        $request['capacity'] = latin_num($request['capacity']);
        $request['start'] = latin_num($request['start']);
        $request['arrival'] = latin_num($request['arrival']);
        $request['departure'] = latin_num($request['departure']);
        $request['end'] = latin_num($request['end']);
        $regex_date = "([1][3,4]\d{2}['\-'|'\/'](0[1-9]|[1-9]|1[0-2])['\-'|'\/'](0[1-9]|[12]\d|3[01]|\d))";
        $this->validate($request, [
            'capacity' => 'required|numeric|between:0,1000000',
            'host_id' => 'required|exists:caravan_hosts,id',
            'province_id' => 'required|exists:cities,id',
            'city_id' => 'required|exists:cities,id',
            'user_id' => 'required|exists:users,id',
            'budget' => ['nullable', 'numeric'],
            'start' => ['required', 'regex:/' . $regex_date . '/'],
            'arrival' => ['nullable', 'regex:/' . $regex_date . '/'],
            'departure' => ['nullable', 'regex:/' . $regex_date . '/'],
            'end' => ['nullable', 'regex:/' . $regex_date . '/'],
        ]);
        $arrival = $request['arrival'] ? shamsi_to_miladi($request['arrival']) : null;
        $departure = $request['departure'] ? shamsi_to_miladi($request['departure']) : null;
        $end = $request['end'] ? shamsi_to_miladi($request['end']) : null;

        $caravan = new \App\caravan();
        $caravan->capacity = $request['capacity'];
        $caravan->dep_province = $request['province_id'];
        $caravan->dep_city = $request['city_id'];
        $caravan->caravan_host_id = $request['host_id'];
        $caravan->duty = $request['user_id'];
        $caravan->budget = $request['budget'] or null;
        $caravan->transport = $request['transport'];
        $caravan->start = shamsi_to_miladi($request['start']);
        $caravan->arrival = $arrival;
        $caravan->departure = $departure;
        $caravan->end = $end;
        $caravan->status = "0";
        $caravan->save();
        $workflow = new caravan_workflow();
        $workflow->caravan_id = $caravan['id'];
        $workflow->status = '1';
        $workflow->save();
        return redirect(route('caravan', ['caravan_id' => $caravan->id]));
    }

    public function add_person_to_caravan(Request $request)
    {

        $request['caravan_id'] = latin_num($request['caravan_id']);
        $request['birth_date'] = latin_num($request['birth_date']);
        $request['national_code'] = latin_num($request['national_code']);
        $request['sh_code'] = latin_num($request['sh_code']);
        $regex_date = "([1][3,4]\d{2}['\-'|'\/'](0[1-9]|[1-9]|1[0-2])['\-'|'\/'](0[1-9]|[12]\d|3[01]|\d))";
        $this->validate($request, [
            'caravan_id' => 'required',
            'sh_code' => 'required',
            'name' => 'required',
            'family' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'birth_date' => ['required', 'regex:/' . $regex_date . '/'],
        ]);
        $caravan = \App\caravan::find($request['caravan_id']);
        if (!in_array($caravan['status'],['1'])){
            $errors[] =trans('errors.caravan_is_not_open');
            return back_error($request,$errors);
        }

        if ($request['person_id']) {
            $this->validate($request, [
                'person_id' => 'required|exists:people,id',
            ]);
            $person = person::find($request['person_id']);
        } else {
            $this->validate($request, [
                'national_code' => 'required|unique:people,national_code',
            ]);

            $person = new person();
            $person->sh_code = $request['sh_code'];
            $person->name = $request['name'];
            $person->family = $request['family'];
            $person->gender = ($request['gender'] == 1 ? true : false);
            $person->father_name = $request['father_name'];
            $person->national_code = $request['national_code'];
            $person->birth_date = shamsi_to_miladi($request['birth_date']);
            $person->save();
        }
        $check_duplicate = person_caravan::where('caravan_id',$request['caravan_id'])->where('person_id',$person->id)->exists();
        if (!$check_duplicate){
            $person_caravan = new person_caravan();
            $person_caravan->caravan_id = $request['caravan_id'];
            $person_caravan->person_id = $person->id;
            $person_caravan->save();
        }
        else{
            $errors[] = trans('errors.person_already_exists');
            return back_error($request,$errors);
        }

        return redirect(route('caravan', ['caravan_id' => $request['caravan_id']]));
    }

    public function action_to_person_caravan_status(Request $request)
    {
        $currentUser = Auth::user();
        $this->validate($request, [
            'person_caravan_id' => 'required|exists:person_caravans,id',
        ]);
        $person_caravan = person_caravan::find($request['person_caravan_id']);
        $caravan = \App\caravan::find($person_caravan['caravan_id']);
        if (!in_array($caravan['status'],['1'])){
            $errors[] =trans('errors.caravan_is_not_open');
            return back_error($request,$errors);
        }
        if ($request['accept']) {
            $person_caravan->accepted = $currentUser['id'];
            $person_caravan->save();
        }
        elseif ($request['reject']){

            $person_caravan->accepted = 0;
            $person_caravan->save();
        }
        else{

        }
        return back_normal($request);
    }

    public function validate_national_code(Request $request)
    {
        $this->validate($request, [
            'national_code' => 'required',
        ]);
        $response = national_code_validation($request['national_code']);
        if (!$response) {
            return 'false';
        }
        return 'true';
    }

    public function change_caravan_status(Request $request)
    {
        $this->validate($request, [
            'caravan_id' => 'required|exists:caravans,id',
        ]);
        $caravan = \App\caravan::find($request['caravan_id']);
        if ($caravan['status'] == "1"){
            $pending_exists = person_caravan::where('accepted',null)->where('caravan_id',$request['caravan_id'])->exists();
            if ($pending_exists){
                $errors[] = trans('errors.pending_person_exists');
                return back_error($request,$errors);
            }
        }
        if (in_array($caravan['status'],["1","2","3","4"])){
            $caravan['status'] = $caravan['status']+1;
        }
        $caravan->save();
        $workflow = new caravan_workflow();
        $workflow->caravan_id = $caravan['id'];
        $workflow->status = $caravan['status'];
        $workflow->small_description = "";
        $workflow->save();
        return back_normal($request);
    }

    public function cancel_caravan_status(Request $request)
    {
        $this->validate($request, [
            'caravan_id' => 'required|exists:caravans,id',
        ]);
        person_caravan::where('caravan_id',$request['caravan_id'])->update(['accepted' => null]);

        $caravan = \App\caravan::find($request['caravan_id']);
        $caravan['status'] = 0;
        $caravan->save();

        $workflow = new caravan_workflow();
        $workflow->caravan_id = $caravan['id'];
        $workflow->status = $caravan['status'];
        $workflow->small_description = "";
        $workflow->save();
        return back_normal($request);
    }

    public function back_caravan_status(Request $request)
    {
        $this->validate($request, [
            'caravan_id' => 'required|exists:caravans,id',
        ]);
        $this->validate($request, [
            'caravan_id' => 'required|exists:caravans,id',
        ]);
        $caravan = \App\caravan::find($request['caravan_id']);
        if ($caravan['status']  == 0 ){
            $caravan['status'] = 1;
        }
        elseif (in_array($caravan['status'],["2","3","4","5"])){
            $caravan['status'] = $caravan['status']-1;
        }
        $caravan->save();
        $workflow = new caravan_workflow();
        $workflow->caravan_id = $caravan['id'];
        $workflow->status = $caravan['status'];
        $workflow->small_description = "";
        $workflow->save();
        return back_normal($request);

    }

}
