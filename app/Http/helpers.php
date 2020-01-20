<?php

use App\gateway;
use App\store_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Team;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;

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

function NestableTableGetData($id, $parent = 0, $extra_float = "", $module = "", $table, $addOne = false, $description = false, $edit = false, $delete = false)
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
                    <a class="btn btn-sm" href="' . route('permissions_team_list', ['team_id' => $select->id]) . '" onclick="nestableRemove_' . $id . '(' . $select->id . ')">' . __('messages.show_permissions') . '</a>';
            }
            if ($description == true) {
                $html .= $select->description;
            }
            if ($edit == true) {
                $html .= '
                <button type="button"
                class="btn btn-sm btn-outline-dark modal-ajax-load"
                data-ajax-link="' . $table . '/edit/' . $select->id . '" data-toggle="modal"
                data-modal-title="' . trans('messages.edit', ['item' => trans('messages.role')]) . '"
                data-target="#general_modal">' . trans('messages.edit') . '</button>';
            }


            $html .= '</span></div>';
            $html .= NestableTableGetData($id, $select->id, $extra_float, $module, $table, $addOne, $description);
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
    $p = explode("public/images/", $folder);
    $destinationPath = 'public/images/' . $folder;
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

function private_file_saver($file_input, $module = "other", $title, $description = "-")
{

    $year = jdate("Y", time(), '', '', 'en');
    $month = jdate("m", time(), '', '', 'en');

    if (!file_exists('storage/docs')) {
        mkdir('storage/docs', 0644, true);
    }
    if (!file_exists('storage/docs/' . $module)) {
        mkdir('storage/docs/' . $module, 0644, true);
    }
    if (!file_exists('storage/docs/' . $module . "/" . $year)) {
        mkdir('storage/docs/' . $module . "/" . $year, 0644, true);
    }
    if (!file_exists('storage/docs/' . $module . "/" . $year . "/" . $month)) {
        mkdir('storage/docs/' . $module . "/" . $year . "/" . $month, 0644, true);
    }
    $destinationPath = 'storage/docs/' . $module . "/" . $year . "/" . $month . "/";
    $time = time();
    $file_name = $time . rand(100000, 999999) . $file_input->getClientOriginalName();
    $file_input->move($destinationPath, $file_name);


    $store_data = new  \App\uploaded_doc();
    $store_data->file_name = $file_name;
    $store_data->mime = $file_input->getClientOriginalExtension();
    $store_data->path = $destinationPath;
    $store_data->url = $destinationPath . $file_name;
    $store_data->title = $title;
    $store_data->description = $description;
    $store_data->save();

    return $store_data->id;

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
        $cities = \App\city::with('province')->find($id);
    } else {
        $cities = \App\city::with(['province' => function ($q) {
            $q->with('province');
        }])->where('parent', '!=', '0')->get();
    }
    return $cities;
}

function get_cites_parent($id)
{

    $this_city = \App\city::find($id);
    if ($this_city['parent'] != 0) {
        $parent = \App\city::find($this_city['parent']);
    } else {
        $parent = false;
    }

    return $parent;
}

function get_cites_list($lvl)
{

    $cities = \App\city::with(['province' => function ($q) {
        $q->with('province');
    }])->where('lvl', $lvl)->get();

    return $cities;
}

function get_provinces($id = null)
{
    if ($id) {
        $provinces = \App\city::with('city')->find($id);
    } else {
        $provinces = \App\city::with('city')->where('parent', '0')->get();
    }
    return $provinces;
}

function get_building_type($id = null)
{
    if ($id) {
        $types = \App\building_type::find($id);
    } else {
        $types = \App\building_type::get();
    }
    return $types;
}

function get_images()
{

    $images = \App\media::get();

    return $images;
}

function get_building_items($project_id)
{
    $items = \App\building_item::where('building_id', $project_id)->get();
    return $items;
}

function get_building_tickets($project_id, $ticket_item_checkbox = null, $ticket_item_filter = null, $ticket_status_checkbox = null, $ticket_status_filter = null)
{
    $tickets_query = \App\building_ticket::query();
    $tickets_query->with('building_item');
    $tickets_query->where('building_id', $project_id);
    $tickets_query->orderBy('created_at', 'desc');
    if ($ticket_item_checkbox == "on" and $ticket_item_filter) {
        $items = [];
        foreach ($ticket_item_filter as $item) {
            $items[] = $item;
        }
        $tickets_query->whereIn('item_id', $items);
    }
    if ($ticket_status_checkbox == "on" and $ticket_status_filter) {
        foreach ($ticket_status_filter as $status) {
            if ($status == 'in_progress') {
                $tickets_query->whereNull('closed');
            } elseif ($status == 'closed') {
                $tickets_query->whereNotNull('closed');
            }
        }
    }
    $tickets = $tickets_query->get();
    return $tickets;
}

function national_code_validation($national_code_in)
{
    $national_code_in = latin_num($national_code_in);
    $national_code = sprintf("%010d", $national_code_in);
    if (!preg_match('/^[0-9]{10}$/', $national_code))

        return false;
    for ($i = 0; $i < 10; $i++)
        if (preg_match('/^' . $i . '{10}$/', $national_code))
            return false;
    for ($i = 0, $sum = 0; $i < 9; $i++)
        $sum += ((10 - $i) * intval(substr($national_code, $i, 1)));
    $ret = $sum % 11;
    $parity = intval(substr($national_code, 9, 1));
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

function get_user($user_id)
{
    $user = \App\User::find($user_id);
    return $user;
}

function get_person($person_id)
{
    $person = \App\person::find($person_id);
    return $person;
}

function count_caravan_useage_history($person_id, $current_caravan_id = null)
{
    $count_query = \App\person_caravan::query();
    $count_query->where('person_id', $person_id);
    $count_query->where('status', "5");
    if ($current_caravan_id) {
        $count_query->where('caravan_id', "!=", $current_caravan_id);
    }
    $count = $count_query->count();
    return $count;
}

function get_caravan_usage_status($caravan_id)
{
    $capacity = \App\caravan::find($caravan_id)['capacity'];
    $accepteds = \App\person_caravan::where('caravan_id', $caravan_id)->where('accepted', ">=", "1")->count();
    $pendings = \App\person_caravan::where('caravan_id', $caravan_id)->where('accepted', null)->count();
    $rejected = \App\person_caravan::where('caravan_id', $caravan_id)->where('accepted', "0")->count();
    $response = [];
    $response['capacity'] = $capacity;
    $response['accepted'] = $accepteds;
    $response['pending'] = $pendings;
    $response['rejected'] = $rejected;
    return $response;
}

function get_caravans_statistics()
{
    $pending = \App\caravan::where('status', '1')->count();
    $response = [];
    $response['pending'] = $pending;
    return $response;
}

function get_caravans_status_text($status)
{
    switch ($status) {
        case "0";
            $response = trans('messages.canceled');
            break;
        case "1";
            $response = trans('messages.registering');
            break;
        case "2";
            $response = trans('messages.ready');
            break;
        case "3";
            $response = trans('messages.arrived');
            break;
        case "4";
            $response = trans('messages.exited');
            break;
        case "5";
            $response = trans('messages.archived');
            break;
        default:
            $response = "";
    }
    return $response;
}

function get_caravan_supervisor($caravan_id)
{
    $supervisors = \App\person_caravan::with('person')->where('caravan_id', $caravan_id)->where('parent_id', null)->get();
    return $supervisors;

}


function get_age($date)
{
    $birthdate = new DateTime(date("Y-m-d", strtotime($date)));
    $today = new DateTime(date("Y-m-d"));
    $age = $birthdate->diff($today)->y;
    return $age;
}

function shamsi_to_miladi($input)
{
    // yyyy/mm/dd
    // yyyy/mm/dd hh:MM:ss
    // yyyy-mm-dd
    // yyyy-mm-dd hh:MM:ss
    if (!$input) {
        return date('Y-m-d H:i:s');
    }
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

function miladi_to_shamsi_date($date = null, $be_array = null, $with_time = false)
{  //2017-01-01 20:30:00
    $time = "";
    if ($with_time) {
        $time = substr(explode(" ", $date)[1], 0, 5);
    }
    if (!isset($date)) {
        $date = date("Y-m-d");
    }
    $new_date = explode(" ", $date);
    $this_date = date("Y-m-d", strtotime($date));
    $new_date = explode("-", $new_date[0]);
    $new_date_day = $new_date[2];
    $new_date_month = $new_date[1];
    $new_date_year = $new_date[0];
    if ($be_array) {
        $date_jalali = gregorian_to_jalali($new_date_year, $new_date_month, $new_date_day);
        return $date_jalali;
    } else {
        $date_jalali = gregorian_to_jalali($new_date_year, $new_date_month, $new_date_day, "-");
        return $time . "  " . $date_jalali;

    }

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

function get_parent_child_checkbox($id, $parent = 0, $table)
{
    $html = '';
    $selects = \Illuminate\Support\Facades\DB::table($table)->where('parent_id', $parent)->get();
    if (sizeof($selects) >= 1) {
        $html .= '<ul class="nav nav-sidebar mb-2">
<li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
            <a href="#" class="nav-link">Street wear</a>
            <ul class="nav nav-group-sub">';
        foreach ($selects as $select) {
            if (key_exists('display_name', $select)) {
                $title = $select->display_name;
            } elseif (key_exists('title', $select)) {
                $title = $select->title;
            }
            $html .= '
            <li class="nav-item">
             <div class="custom-control custom-checkbox custom-control-inline">
    <input type="checkbox" class="custom-control-input" value="' . $select->id . '" id="cat_' . $select->id . '" checked>
    <label class="custom-control-label" for="custom_checkbox_inline_unchecked">' . $title . '</label>
</div>
</li>
           ';
            $html .= get_parent_child_checkbox($id, $select->id, $table);
            $html .= '</li>';
        }
        $html .= '</li></a></ul></ul>';
    }
    return $html;
}

function treeView($checked = [])
{
    $Categorys = store_category::where('parent_id', '=', 0)->get();
    $tree = '<ul id="browser" class="list-unstyled"><li class="pt-2"></li>';
    foreach ($Categorys as $Category) {
        $check = '';
        if (in_array($Category->id, $checked)) {
            $check = "checked='checked'";
        }
        $tree .= '<li class="pt-2 closed"<a class="tree-name">
<div class="custom-control custom-checkbox custom-control-inline">
    <input type="checkbox" ' . $check . ' class="custom-control-input" id="cat_' . $Category->id . '" name="cats[]" value="' . $Category->id . '">
    <label class="custom-control-label" for="cat_' . $Category->id . '">' . $Category->title . '</label>
</div></a>';
        if (count($Category->childs)) {
            $tree .= childView($Category, $checked);
        }
    }
    $tree .= '<ul>';
    // return $tree;
    return $tree;
}

function childView($Category, $checked = [])
{
    $html = '<ul>';
    foreach ($Category->childs as $arr) {
        $check = '';
        if (in_array($arr->id, $checked)) {
            $check = "checked='checked'";
        }
        if (count($arr->childs)) {

            $html .= '<li class="pt-2 closed list-unstyled">
<a class="tree-name">
<div class="custom-control custom-checkbox custom-control-inline">
    <input type="checkbox" class="custom-control-input" ' . $check . ' id="cat_' . $arr->id . '"  name="cats[]" value="' . $Category->id . '">
    <label class="custom-control-label" for="cat_' . $arr->id . '">' . $arr->title . '</label>
</div>
</a>';
            $html .= childView($arr);
        } else {
            $html .= '<li class="pt-2 list-unstyled">
<div class="custom-control custom-checkbox custom-control-inline">
    <input type="checkbox" ' . $check . ' class="custom-control-input" id="cat_' . $arr->id . '"  name="cats[]" value="' . $Category->id . '">
    <label class="custom-control-label" for="cat_' . $arr->id . '">' . $arr->title . '</label>
</div>';
            $html .= "</li>";
        }

    }

    $html .= "</ul>";
    return $html;
}


function get_inventory_size_max_time($pro_id)
{

}

function get_blog_categories()
{
    $categories = \WebDevEtc\BlogEtc\Models\BlogEtcCategory::where('lang',app()->getLocale())->get();
    return $categories;
}

function get_option($option_name, $limit = 0, $random = false)
{
    $option_query = \App\blog_option::query();
    $option_query->where('name', $option_name);

    if ($random) {
        $option_query->inRandomOrder();
    }
    if ($limit) {
        $option_query->limit($limit);
    }
    $options = $option_query->get();
    return $options;
}

function get_posts($limit = null, $main_page = [], $categories = [], $paginate = 0)
{
    $posts_query = WebDevEtc\BlogEtc\Models\BlogEtcPost::query();
    if ($main_page and in_array('last_post', $main_page)) {
        $posts_query->whereHas('categories', function ($q) {
            $q->where('last_post', true);
        });
    }
    if ($main_page and in_array('articles', $main_page)) {
        $posts_query->whereHas('categories', function ($q) {
            $q->where('articles', true);
        });
    }
    $posts_query->where("lang", app()->getLocale());
    $posts_query->orderBy("posted_at", "desc");
    $posts_query->with('categories');
    $posts_query->where('lang',App()->getLocale());
    if (!empty($categories)) {
        $posts_query->take($categories);
    }
    if (!empty($limit)) {
        $posts_query->take($limit);
    }
    if ($paginate) {
        $posts =$posts_query->paginate($paginate);
    }
    else {
        $posts= $posts_query->get();
    }
    return $posts;
}

function get_photo_gallery($limit = 12, $gallery = false, $random = true, $gallery_id = [])
{
    if ($gallery) {
        $response_query = \App\gallery_category::query();
    } else {
        $response_query = \App\media::query();
        $response_query->where('module', 'gallery');
        if (!empty($gallery_id)) {
            $response_query->whereIn('category_id', $gallery_id);
        }
    }
    $response_query->limit($limit);
    if ($random) {
        $response_query->inRandomOrder();
    }
    if ($limit == 1) {
        $response = $response_query->first();
    } else {
        $response = $response_query->get();
    }

    return $response;
}

function get_video_gallery($limit = 1, $random = false, $video_id = [])
{

    $response_query = \App\video_gallery::query();
    if (!empty($video_id)) {
        $response_query->whereIn('id', $video_id);
    }

    if ($random) {
        $response_query->inRandomOrder();
    }
    if ($limit == 1) {
        $response = $response_query->first();
    } elseif ($limit == 0) {
        $response = $response_query->paginate(25);
    } else {
        $response_query->limit($limit);
        $response = $response_query->get();
    }

    return $response;
}

function uploadGallery($file, $folder = 'photos', $additional = ['category_id' => '', 'title' => ''], $custom_size = array('150,178', '300,200', '600,400'))
{

    $fileSize = $file->getSize();
    $year = jdate("Y", time(), '', '', 'en');
    $month = jdate("m", time(), '', '', 'en');

    if (!file_exists('public/images')) {
        mkdir('public/images', 0775, true);
    }
    if (!file_exists('public/images/' . $folder)) {
        mkdir('public/images/' . $folder, 0775, true);
    }
    if (!file_exists('public/images/' . $folder . "/" . $year)) {
        mkdir('public/images/' . $folder . "/" . $year, 0775, true);
    }
    if (!file_exists('public/images/' . $folder . "/" . $year . "/" . $month)) {
        mkdir('public/images/' . $folder . "/" . $year . "/" . $month, 0775, true);
    }
    $destinationPath = 'public/images/' . $folder . "/" . $year . "/" . $month;
    $time = time();
    $image_name = $time . '_' . request()->file->getClientOriginalName();
    \App\media::create([
        'name' => $image_name,
        'url' => $destinationPath . "/" . $image_name,
        'path' => $destinationPath,
        'org_name' => request()->file->getClientOriginalName(),
        'mime' => request()->file->getClientMimeType(),
        'module' => $folder,
        'type' => request()->file->getClientOriginalExtension(),
        'size' => $fileSize,
        'category_id' => $additional['category_id'],
        'title' => $additional['title'],
    ]);

    $size = array();
    $size = array_merge($size, $custom_size);
    foreach ($size as $value) {
        $si = explode(',', $value);
        if (!file_exists('public/images/' . $folder . "/" . $year . "/" . $month . "/" . $si[0])) {
            mkdir('public/images/' . $folder . "/" . $year . "/" . $month . "/" . $si[0], 0775, true);
        }
        $thumbnailPath = 'public/images/' . $folder . '/' . $year . "/" . $month . "/" . $si[0];
        $img = Image::make($file->getRealPath());
        $filename = $time . "_" . $file->getClientOriginalName();

        $img->resize($si[0], null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailPath . '/' . $filename);
    }

    $file->move($destinationPath, $image_name);
}

function uploadFile($file, $folder = 'files')
{

    if (!file_exists('public/files')) {
        mkdir('public/files', 0755, true);
    }
    if (!file_exists('public/files/' . $folder)) {
        mkdir('public/files/' . $folder, 0755, true);
    }

    $destinationPath = 'public/files/' . $folder;
    $fileName = request()->file->getClientOriginalName();

    $file->move($destinationPath, $fileName);
    return $destinationPath . '/' . $fileName;
}

function has_caravan()
{
    if (Auth::check() and \App\caravan::where('duty', \auth()->id())->whereIn('status', ['1', '2', '3', '4'])->exists()) {
        return true;
    }
    return null;
}

function notification_messages($module, $key, $variables = [])
{
    $message = \App\notification_template::where('module', $module)->where('key', $key)->first();
    foreach ($variables as $name => $variable) {
        $message['text'] = preg_replace("/({( )*" . $name . "( )*})/", $variable, $message['text']);
    }
    $variables = explode(',',$message['variables']);
    foreach ($variables as $variable) {
        $message['text'] = preg_replace("/({( )*" . $variable . "( )*})/", "", $message['text']);
    }

    $message['text']=strip_tags($message['text']);
    return $message;
}

function get_all_locals(){
    $locales = array_merge([config('app.locale')],
        \Barryvdh\TranslationManager\Models\Translation::groupBy('locale')->pluck('locale')->toArray());

    $locales = array_unique($locales);
    return $locales;
}

function sendSms ($mobile,$body,$farsi=true) {
    $mobile = trim($mobile);
    if (strlen($mobile) >= 10 and strlen($mobile)<=14){
        $mobile = "0".substr($mobile,strlen($mobile)-10,10);
    }
    $regex = "/(09)\d{9}\s{1}P/";
    if(preg_match($regex,$mobile." P")) {
        $wsdl = "http://sms1000.ir/webservice/sms.asmx?wsdl";
        $client = new nusoap_client($wsdl, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $client->decode_utf8 = true;
        $param = array(
            'uUsername' => 'anbiya',
            'uPassword' => '131571',
            'uNumber' => 1000454646, //شماره اختصاصی
            'uCellphones' => $mobile,
            'uMessage' => $body,
            'uFarsi' => $farsi
        );
        $results = $client->call('doSendSMS', $param);
        return $results;
    }
    /*include ('/home/ashraf/public_html/include/libs/class.sms.php');
    $sms = new sms();
    $sms->SendSMS($mobile, $body);*/
}

