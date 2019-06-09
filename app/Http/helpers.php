<?php
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

function NestableTableGetData($id, $parent = 0, $extra_float = "", $module = "")
{
    $html = '';
    $selects = \App\Team::where('parent_id', $parent)->get();
    if (sizeof($selects) >= 1) {
        $html .= '<ol class="dd-list dd-list-rtl" id="nestable_dd_list_' . $id . '">';
        foreach ($selects as $select) {
            $title = $select->display_name;
            $html .= '
            <li class="dd-item dd3-item" data-id="' . $select->id . '">
                <div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">' . $title . '
                <span class="float-right" style="margin-top: -5px;">';
            if (isset($extra_float[$select->id])) {
                $html .= $extra_float[$select->id];
            }
            $html .= '
                    <a class="btn btn-sm" href="javascript:;" onclick="nestableRemove_' . $id . '(' . $select->id . ')">delete</a>
                </span></div>';
            $html .= NestableTableGetData($id, $select->id, $extra_float, $module);
            $html .= '</li>';
        }
        $html .= '</ol>';
    }
    return $html;
}

function NesatableUpdateSort($sub, $jde)
{
    $js = 0;
    foreach ($jde as $j) {
        \App\Team::where('id', $j['id'])->update(['parent_id' => $sub]);
        $js++;
        if (isset($j['children']) && is_array($j['children'])) {
            NesatableUpdateSort($j['id'], $j['children']);
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

function user_information($type)
{
    $user = Auth::user();
    if($type=='full'){
        return $user->name;
    }elseif($type=='email'){
        return $user->email;
    }elseif($type=='id'){
        return $user->id;
    }elseif ($type=='avatar'){
        if($user->avatar!="") {
            return $user->avatar;
        }else{
            return '/public/assets/panel/images/person.png';
        }
    }
}

