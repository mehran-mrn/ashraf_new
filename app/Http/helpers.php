<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Team;

/**
 * Created by PhpStorm.
 * User: asus
 * Date: 04/06/2019
 * Time: 08:43 PM
 */

function back_error($request, $errors)
{
    if ($request->ajax()) {
        $errors_array = ['message' => "has error",
            "errors" => $errors];
        return response()->json($errors_array, 404);
    }
    return back()->withErrors($errors);
}

function back_normal($request, $message = null)
{
    if (!isset($message)) {
        $message = "Done!";
    }
    if ($request->ajax()) {
        return response()->json(['message' => $message]);
    }
    return back()->with('message', $message);
}

function NestableTableGetData($id, $parent = 0, $extra_float = "", $module = "", $table, $addOne = false)
{
    $html = '';
//    $selects = Team::where('parent_id', $parent)->get();
    $selects = \Illuminate\Support\Facades\DB::table($table)->where('parent_id', $parent)->get();
    if (sizeof($selects) >= 1) {
        $html .= '<ol class="dd-list dd-list-rtl" id="nestable_dd_list_' . $id . '">';
        foreach ($selects as $select) {
            if (key_exists('display_name', $select)) {
                $title = $select->display_name;
            } elseif (key_exists('title', $select)) {
                $title = $select->title;
            }
            $html .= '
            <li class="dd-item dd3-item" data-id="' . $select->id . '">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">' . $title . '
                <span class="float-right" style="margin-top: -5px;">';
            if (isset($extra_float[$select->id])) {
                $html .= $extra_float[$select->id];
            }
            if ($addOne == true) {
                $html .= '
                    <a class="btn btn-sm" href="' . route('permissions_team_list', $select->id) . '" onclick="nestableRemove_' . $id . '(' . $select->id . ')">' . __('messages.show_permissions') . '</a>';
            }
            $html .= '</span></div>';
            $html .= NestableTableGetData($id, $select->id, $extra_float, $module, $table,$addOne);
            $html .= '</li>';
        }
        $html .= '</ol>';
    }
    return $html;
}

function NesatableUpdateSort($sub, $jde, $table)
{
    $js = 0;
    foreach ($jde as $j) {
        \Illuminate\Support\Facades\DB::table($table)->where('id', $j['id'])->update(['parent_id' => $sub]);
//        \App\Team::where('id', $j['id'])->update(['parent_id' => $sub]);
        $js++;
        if (isset($j['children']) && is_array($j['children'])) {
            NesatableUpdateSort($j['id'], $j['children'], $table);
        }

    }
}

function get_team($team_id = null)
{
    if (!$team_id) {
        $team['display_name'] = trans('messages.all_teams');
    } else {
        $team = \App\Team::find($team_id);
        if (!$team) {
            $team['display_name'] = trans('messages.team_not_found');
        }
    }
    return $team;
}

function image_saver($image_input, $folder = 'photos', $module = 'none', $custom_size = [], $image_name = null)
{
//    $request->validate([
//        'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif|max:8193|dimensions:min_width=75,min_height=75',
//    ]);
    if (!file_exists('public/images')) {
        mkdir('public/images', 0755, true);
    }
    if (!file_exists('public/images/' . $folder)) {
        mkdir('public/images/' . $folder, 0755, true);
    }

//    $image = $request->file('image');
    $image = $image_input;
    $destinationPath = 'public/images/' . $folder;
    if (empty($image_name)) {
        $image_name = mt_rand() . time() . '.' . $image->getClientOriginalExtension();
    } else {
        $image_name = pathinfo($image_name)['filename'] . '.' . $image->getClientOriginalExtension();

    }

    $size = ['100,100', '200,200', '400,400'];
    array_merge($size, $custom_size);

    foreach ($size as $value) {
        $si = explode(',', $value);
        if (!file_exists('public/images/' . $folder . "/" . $si[0] . "x" . $si[1])) {
            mkdir('public/images/' . $folder . "/" . "/" . $si[0] . "x" . $si[1], 0755, true);
        }
        $thumbnailPath = 'public/images/' . $folder . '/' . $si[0] . "x" . $si[1];
        $img = Image::make($image->getRealPath());
        $img->resize($si[0], $si[1], function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailPath . '/' . $image_name);
        \App\media::create([
            'name' => $image_name,
            'url' => $thumbnailPath . "/" . $image_name,
            'path' => $thumbnailPath,
            'org_name' => $image->getClientOriginalName(),
            'mime' => $image->getClientMimeType(),
            'module' => $module,
            'size' => "1",
            'type' => "image"
        ]);
    }

    $image->move($destinationPath, $image_name);
    $media_info = \App\media::create([
        'name' => $image_name,
        'url' => $destinationPath . "/" . $image_name,
        'path' => $destinationPath,
        'org_name' => $image->getClientOriginalName(),
        'mime' => $image->getClientMimeType(),
        'module' => $module,
        'size' => "1",
        'type' => "image"
    ]);
    $media_id = $media_info->id;

    return $media_id;
}

function file_saver($image_input, $folder = 'photos', $module = 'none', $custom_size = [], $image_name = null)
{

//    $image = $request->file('image');
    $image = $image_input;
    $p = explode("public/", $folder);
    $destinationPath = 'public/' . $p[1];
    $id = \App\media::create([
        'name' => ' ',
        'url' => ' ',
        'path' => $destinationPath,
        'org_name' => $image->getClientOriginalName(),
        'mime' => $image->getClientMimeType(),
        'module' => $module,
        'size' => "1",
        'type' => "image"
    ]);
    $image_name = $id->id . '__' . $image->getClientOriginalName() . $image->getClientOriginalExtension();
    \App\media::where('id', $id->id)->update(
        [
            'name' => $image_name,
            'url' => $destinationPath,
        ]
    );
    $media_id = $id->id;

    return $media_id;
}

function private_image_saver($image_input, $folder, $module, $image_name = null)
{
//    $request->validate([
//        'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif|max:8193|dimensions:min_width=75,min_height=75',
//    ]);
    if (!file_exists('storage/user_doc')) {
        mkdir('storage/user_doc', 0644, true);
    }
    if (!file_exists('storage/user_doc/' . $folder)) {
        mkdir('storage/user_doc/' . $folder, 0644, true);
    }
//    $image = $request->file('image');
    $image = $image_input;
    $destinationPath = 'storage/user_doc/' . $folder;
    if (empty($image_name)) {
        $image_name = mt_rand() . time() . '.' . $image->getClientOriginalExtension();
    } else {
        $image_name = pathinfo($image_name)['filename'] . '.' . $image->getClientOriginalExtension();

    }
    $image->move($destinationPath, $image_name);
    $media_info = \App\media::create([
        'name' => $image_name,
        'url' => $destinationPath . "/" . $image_name,
        'path' => $destinationPath,
        'org_name' => $image->getClientOriginalName(),
        'mime' => $image->getClientMimeType(),
        'module' => $module,
        'size' => "1"
    ]);
    $media_id = $media_info->id;
    return $media_id;
}

function user_information($type)
{
    $user = \Illuminate\Support\Facades\Auth::user();
    if ($type == 'full') {
        return $user->name;
    } elseif ($type == 'email') {
        return $user->email;
    } elseif ($type == 'id') {
        return $user->id;
    } elseif ($type == 'avatar') {
        if ($user->avatar != "") {
            return $user->avatar;
        } else {
            return '/public/assets/panel/images/person.png';
        }
    }
}

function get_cites($id = null)
{
    if ($id) {
        $cities = \App\city::find($id);
    } else {
        $cities = \App\city::where('parent', '!=', '0')->get();
    }
    return $cities;
}

function get_provinces($id = null)
{
    if ($id) {
        $provinces = \App\city::find($id);
    } else {
        $provinces = \App\city::where('parent', '0')->get();
    }
    return $provinces;
}

function national_code_validation($natinoal_code)
{
    if (!preg_match('/^[0-9]{10}$/', $natinoal_code))
        return false;
    for ($i = 0; $i < 10; $i++)
        if (preg_match('/^' . $i . '{10}$/', $natinoal_code))
            return false;
    for ($i = 0, $sum = 0; $i < 9; $i++)
        $sum += ((10 - $i) * intval(substr($natinoal_code, $i, 1)));
    $ret = $sum % 11;
    $parity = intval(substr($natinoal_code, 9, 1));
    if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
        return true;
    return false;
}

function get_hosts($id = null)
{
    if ($id) {
        $host = \App\caravan_host::find($id);
    } else {
        $host = \App\caravan_host::get();
    }
    return $host;
}

function shamsi_to_miladi($input)
{
    // yyyy/mm/dd
    // yyyy/mm/dd hh:MM:ss
    // yyyy-mm-dd
    // yyyy-mm-dd hh:MM:ss

    $input = str_replace("    ", " ", $input);
    $input = str_replace("   ", " ", $input);
    $input = str_replace("  ", " ", $input);
    $date_array = explode(" ", $input);
    $date = $date_array[0];
    $time = (empty($date_array[1]) ? "00:00:00" : $date_array[1]);
    if (strpos($date, '-') > 0 and strpos($date, '/') == false) {
        $new_date = explode("-", $date);
    } elseif (strpos($date, "-") == false and strpos($date, "/") > 0) {
        $new_date = explode("/", $date);
    } else {
        return false;
    }
    $new_date_day = $new_date[2];
    $new_date_month = $new_date[1];
    $new_date_year = $new_date[0];
    if ($new_date_year > 1800) {//if input is not shamsi date
        return false;
    }

    $date_gregorian = jalali_to_gregorian($new_date_year, $new_date_month, $new_date_day, "-");

    $date_gregorian = $date_gregorian . " " . $time;
    return $date_gregorian;

}

function miladi_to_shamsi_date($date = null, $be_array = null)
{  //2017-01-01 20:30:00
    if (!isset($date)) {
        $date = date("Y-m-d");
    }
    $new_date = explode(" ", $date);
    $this_date = date("Y-m-d", strtotime($date));
    $new_date = explode("-", $new_date[0]);
    $new_date_day = $new_date[2];
    $new_date_month = $new_date[1];
    $new_date_year = $new_date[0];
    if (!empty($be_array)) {
        $date_jalali = gregorian_to_jalali($new_date_year, $new_date_month, $new_date_day);

    } else {
        $date_jalali = gregorian_to_jalali($new_date_year, $new_date_month, $new_date_day, "-");
    }
    return $date_jalali;

}

function persian_num($string)
{
    //arrays of persian and latin numbers
    $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $latin_num = range(0, 9);

    $string = str_replace($latin_num, $persian_num, $string);

    return $string;
}

function latin_num($string)
{
    //arrays of persian and latin numbers
    $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $latin_num = range(0, 9);

    $string = str_replace($persian_num, $latin_num, $string);

    return $string;
}

function get_file_id($fileName)
{
    $exe = explode('/', $fileName);
    $fileInfo = explode("__", $exe[sizeof($exe) - 1]);
    return $fileInfo[0];
}


function get_parent_child_checkbox($id, $parent = 0, $extra_float = "", $module = "", $table, $addOne = false)
{
    $html = '';
    $selects = \Illuminate\Support\Facades\DB::table($table)->where('parent_id', $parent)->get();
    if (sizeof($selects) >= 1) {
        $html .= '<ol class="dd-list dd-list-rtl" id="nestable_dd_list_' . $id . '">';
        foreach ($selects as $select) {
            if (key_exists('display_name', $select)) {
                $title = $select->display_name;
            } elseif (key_exists('title', $select)) {
                $title = $select->title;
            }
            $html .= '
            <li class="dd-item dd3-item" data-id="' . $select->id . '">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">' . $title . '
                <span class="float-right" style="margin-top: -5px;">';
            if (isset($extra_float[$select->id])) {
                $html .= $extra_float[$select->id];
            }
            if ($addOne == true) {
                $html .= '
                    <a class="btn btn-sm" href="' . route('permissions_team_list', $select->id) . '" onclick="nestableRemove_' . $id . '(' . $select->id . ')">' . __('messages.show_permissions') . '</a>';
            }
            $html .= '</span></div>';
            $html .= NestableTableGetData($id, $select->id, $extra_float, $module, $table,$addOne);
            $html .= '</li>';
        }
        $html .= '</ol>';
    }
    return $html;
}


