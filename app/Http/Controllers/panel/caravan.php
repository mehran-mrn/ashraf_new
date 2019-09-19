<?php

namespace App\Http\Controllers\panel;

use App\caravan_doc;
use App\caravan_host;
use App\caravan_workflow;
use App\person;
use App\person_caravan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Excel;
use App\Imports\UsersImport;

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
            'title' => 'required',
            'capacity' => 'required|numeric|between:0,1000000',
            'host_id' => 'required|exists:caravan_hosts,id',
            'province_id' => 'required|exists:cities,id',
            'city_id_2' => 'required|exists:cities,id',
            'user_id' => 'required|exists:users,id',
            'budget' => ['nullable', 'numeric'],
//            'start' => ['required', 'regex:/' . $regex_date . '/'],
            'start' => 'required',
            'arrival' => 'nullable',
            'departure' => 'nullable',
            'end' => 'nullable',
        ]);
        $arrival = $request['arrival'] ? shamsi_to_miladi($request['arrival']) : null;
        $departure = $request['departure'] ? shamsi_to_miladi($request['departure']) : null;
        $end = $request['end'] ? shamsi_to_miladi($request['end']) : null;

        $caravan = new \App\caravan();
        $caravan->title = $request['title'];
        $caravan->capacity = $request['capacity'];
        $caravan->dep_province = $request['province_id'];
        $caravan->dep_city = $request['city_id_2'];
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
            'name' => 'required',
            'family' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'birth_date' => ['required', 'regex:/' . $regex_date . '/'],
        ]);
        $caravan = \App\caravan::find($request['caravan_id']);
        if (!in_array($caravan['status'], ['1'])) {
            $errors[] = trans('errors.caravan_is_not_open');
            return back_error($request, $errors);
        }

        if (!$request['person_id']) {

            $this->validate($request, [
                'national_code' => 'required',
            ]);

            $person = person::where('national_code', $request['national_code'])->first();
            if (!$person) {
                if ($this->validate_national_code($request) != 'true') {
                    $errors[] = trans('errors.national_code_is_incorrect');
                    return back_error($request, $errors);
                }

                $person = new person();
                $person->sh_code = $request['sh_code'];
                $person->name = $request['name'];
                $person->family = $request['family'];
                $person->gender = ($request['gender'] == 1 ? true : false);
                $person->father_name = $request['father_name'];
                $person->national_code = $request['national_code'];
                $person->phone = $request['phone'];
                $person->madadjoo_id = $request['madadjoo_id'];
                $person->birth_date = shamsi_to_miladi($request['birth_date']);
                $person->save();
            }
            else{
                if ($request['phone']){
                    $person->phone = $request['phone'];
                    $person->save();

                }
            }
            $check_duplicate = person_caravan::where('caravan_id', $request['caravan_id'])->where('person_id', $person->id)->exists();
            if (!$check_duplicate) {
                $person_caravan = new person_caravan();
                $person_caravan->caravan_id = $request['caravan_id'];
                $person_caravan->person_id = $person->id;
                $person_caravan->relation = $request['relation'];
                $person_caravan->parent_id = $request['parent_id'];
                $person_caravan->save();
            } else {
                $errors[] = trans('errors.person_already_exists');
                return back_error($request, $errors);
            }
        } else {

            $this->update_person_caravan_data($request,$request['person_id']);
        }

        return back();

//        return redirect(route('caravan', ['caravan_id' => $request['caravan_id']]));
    }

    public function update_person_caravan_data(Request $request,$person_caravan_id)
    {
        if ($this->validate_national_code($request) != 'true') {
            $errors[] = trans('errors.national_code_is_incorrect');
            return back_error($request, $errors);
        }
        $person_caravan = person_caravan::find($person_caravan_id);
        $person_caravan->relation = $request['relation'];
        $person_caravan->parent_id = $request['parent_id'];
        $person_caravan->save();
        $person = person::find($person_caravan['person_id']);
        $person->sh_code = $request['sh_code'];
        $person->name = $request['name'];
        $person->family = $request['family'];
        $person->gender = ($request['gender'] == 1 ? true : false);
        $person->father_name = $request['father_name'];
        $person->national_code = $request['national_code'];
        $person->phone = $request['phone'];
        $person->madadjoo_id = $request['madadjoo_id'];
        $person->birth_date = shamsi_to_miladi($request['birth_date']);
        $person->save();
        return redirect(route('caravan', ['caravan_id' => $person_caravan['caravan_id']]));
    }

    public function add_person_to_caravan_excel(Request $request)
    {
        $this->validate($request, [
            'import_file' => 'bail|required|mimes:xlsx|max:60000',
            'caravan_id' => 'required|exists:caravans,id',
        ]);
        $caravan = \App\caravan::find($request['caravan_id']);
        if (!in_array($caravan['status'], ['1'])) {
            $errors[] = trans('errors.caravan_is_not_open');
            return back_error($request, $errors);
        }

        $excel_response[] = trans('messages.file_uploaded');
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $raw_data = Excel::toArray(new UsersImport, request()->file('import_file'));
            $data = [];
            foreach ($raw_data[0] as $key => $value) {
                if ($key != 0 and count(array_filter($value)) > 0)
                    $data[] = array_combine($raw_data[0][0], $value);
            }


            if (!empty($data)) {
                $parent_id = null;
                foreach ($data as $key => $value) {
                    $validator = Validator::make($value, [
                        'name' => 'bail|required|max:255',
                        'family' => 'bail|required|max:255',
                        'father_name' => 'bail|required|max:255',
                        'meli' => 'required|unique:people,national_code',
                        'gender' => 'required',
                        'relation' => 'required',
                        'phone' => 'nullable',
                        'day' => 'numeric|digits_between:1,2',
                        'month' => 'numeric|digits_between:1,2',
                        'year' => 'numeric|digits:4',
                    ]);
                    if (!$validator->fails() and in_array(trim($value['gender']), ['زن', 'ز', '1', 'موئنث', 'خانم', 'دختر', 'دختربچه', 'دختر بچه', 'موءنث', 'g', 'w', 'f', 'girl', 'women', 'woman'])) {
                        $value['gender'] = 1;
                    } else {
                        $value['gender'] = 0;
                    }
                    if ($validator->fails()) {
                        if (implode($value)){
                        $validate_response= __('words.row') . ($key + 2) . " : " . "\r\n";
                        foreach ($validator->messages()->messages() as $key=>$value){
                            $validate_response .=  $value[0] . "\r\n";
                        }
                        $validate_response .=  "\r\n";
                        $excel_response[] =$validate_response;
                        }
                        continue;
                    } else {
                        if ($this->validate_national_code($request, $value['meli']) != 'true') {

                            $excel_response[] = "line - " . ($key + 2) . "  " . trans('errors.national_code_is_incorrect')." " . "\r\n";
                        } else {
                            $person = person::where('national_code', $request['meli'])->first();
                            if (!$person) {
                                $birt_date = sprintf("%04d", $value['year']) . "-" . sprintf("%02d", $value['month']) . "-" . sprintf("%02d", $value['day']);
                                $person = new person();
                                $person->sh_code = $value['shenasname'];
                                $person->name = $value['name'];
                                $person->family = $value['family'];
                                $person->gender = ($value['gender'] == 1 ? true : false);
                                $person->father_name = $value['father_name'];
                                $person->national_code = $value['meli'];
                                $person->phone = $value['phone'];
                                $person->madadjoo_id = $value['madadjoo_id'];
                                $person->birth_date = shamsi_to_miladi($birt_date);
                                $person->save();
                            }
                            $relation ="";
                            switch ($value['relation']){
                                case "سرپرست":
                                    $parent_id=$person['id'];
                                    $relation="supervisor";
                                    break;
                                case "مربی":
                                    $parent_id=$person['id'];
                                    $relation="handler";
                                    break;
                                case "فرزند":
                                    $relation="child";
                                    break;
                                case "نوه":
                                    $relation="grandchild";
                                    break;
                                case "همسر":
                                    $relation="partner";
                                    break;
                                default:

                            }
                            $check_duplicate = person_caravan::where('caravan_id', $request['caravan_id'])->where('person_id', $person->id)->exists();
                            if (!$check_duplicate) {
                                $person_caravan = new person_caravan();
                                $person_caravan->caravan_id = $request['caravan_id'];
                                $person_caravan->person_id = $person->id;
                                $person_caravan->relation = $relation;
                                $person_caravan->parent_id = $parent_id==$person->id ? "":$parent_id;
                                $person_caravan->save();
                            } else {
                                $excel_response[] = "line - " . ($key + 2) . "  " . trans('errors.person_already_exists');
                            }
                        }
                    }
                }

            }
        }
        return redirect()->back()->with('excel_response', $excel_response);

    }

    public function delete_person_from_caravan($id, Request $request)
    {
        $person_caravan = person_caravan::find($id);
        $person_caravan->delete();
        $messages = trans('messages.item_deleted', ['item' => trans('words.person')]);
        return back_normal($request, $messages);
    }

    public function action_to_person_caravan_status(Request $request)
    {
        $currentUser = Auth::user();
        $this->validate($request, [
            'person_caravan_id' => 'required|exists:person_caravans,id',
        ]);
        $person_caravan = person_caravan::find($request['person_caravan_id']);
        $caravan = \App\caravan::find($person_caravan['caravan_id']);
        if ($request['accept']) {
            $person_caravan->accepted = $currentUser['id'];
            $person_caravan->comment = $request['comment'];
            $person_caravan->save();
        } elseif ($request['reject']) {
            $person_caravan->accepted = 0;
            $person_caravan->comment = $request['comment'];
            $person_caravan->save();
        } else {

        }
        return back_normal($request);
    }

    public function validate_national_code(Request $request, $national_code = null)
    {
        if ($national_code) {
            $request['national_code'] = $national_code;
        } else {
            $this->validate($request, [
                'national_code' => 'required',
            ]);
        }

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
        if ($caravan['status'] == "1") {
            $pending_exists = person_caravan::where('accepted', null)->where('caravan_id', $request['caravan_id'])->exists();
            if ($pending_exists) {
                $errors[] = trans('errors.pending_person_exists');
                return back_error($request, $errors);
            }
        }
        if (in_array($caravan['status'], ["1", "2", "3", "4"])) {
            $caravan['status'] = $caravan['status'] + 1;
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
        person_caravan::where('caravan_id', $request['caravan_id'])->update(['accepted' => null]);

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
        if ($caravan['status'] == 0) {
            $caravan['status'] = 1;
        } elseif (in_array($caravan['status'], ["2", "3", "4", "5"])) {
            $caravan['status'] = $caravan['status'] - 1;
        }
        $caravan->save();
        $workflow = new caravan_workflow();
        $workflow->caravan_id = $caravan['id'];
        $workflow->status = $caravan['status'];
        $workflow->small_description = "";
        $workflow->save();
        return back_normal($request);

    }

    public function upload_caravan_doc(Request $request){
        $this->validate($request, [
            'file' => 'required|file|max:10240',
            'title' => 'required',
            'caravan_id' => 'required|exists:caravans,id',
            'description' => 'required',
        ]);

        $doc_id = private_file_saver($request->file,'caravan',$request['title'],$request['description']);
        $pivot = new caravan_doc();
        $pivot->caravan_id=$request['caravan_id'];
        $pivot->doc_id=$doc_id;
        $pivot->save();
        return back_normal($request);
    }

}
