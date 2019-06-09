<?php

namespace App\Http\Controllers\panel;

use App\Permission;
use App\Role;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class user_manager extends Controller
{
    //
    public function register(Request $request)
    {
//        $currentUser = Auth::user();
        $this->validate($request, [
            'email' => 'required_without_all:phone|nullable|unique:users',
            'phone' => 'required_without_all:email|nullable|numeric|regex:/(09)[0-9]{9}/|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->username ,
            'email' => $request->email ,
            'phone' =>  $request->phone ,
            'disabled' =>  1,
//            'last_modifier' =>  $currentUser->id,
            'password' => bcrypt($request->password),
        ]);
        $message =trans("messages.user_created");
        return back_normal($request,$message);


    }

    public function register_permission(Request $request){
        $this->validate($request, [
            'key' => 'required|unique:permissions,name',
            'display_name' => 'required|unique:permissions',
        ]);

        Permission::create([
            'name' => $request->key ,
            'display_name' => $request->display_name ,
            'category' => $request->category ,
            'description' =>  $request->description ,
        ]);
        $message =trans("messages.item_created",['item'=>trans('messages.permission')]);
        return back_normal($request,$message);
    }
    public function register_role(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:permissions',
            'display_name' => 'required|unique:permissions',
        ]);

        Role::create([
            'name' => $request->name ,
            'display_name' => $request->display_name ,
            'description' =>  $request->description ,
        ]);
        $message =trans("messages.item_created",['item'=>trans('messages.role')]);
        return back_normal($request,$message);
    }
    public function register_team(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:permissions',
            'display_name' => 'required|unique:permissions',
        ]);

         Team::create([
            'name' => $request->name ,
            'display_name' => $request->display_name ,
            'description' =>  $request->description ,
        ]);
        $message =trans("messages.item_created",['item'=>trans('messages.team')]);
        return back_normal($request,$message);
    }
    public function assign_user_to_permission(Request $request){
        $this->validate($request, [
            'permission_id' => 'required|exists:permissions,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $permission = Permission::find($request['permission_id']);
        $user = User::find($request['user_id']);
        $user->attachPermission($permission);

        return back_normal($request);
    }
    public function assign_role_to_permission(Request $request){
        $this->validate($request, [
            'permission_id' => 'required|exists:permissions,id',
            'roles_id' => 'required',
            'teams_id' => 'required',
        ]);
        $permission = Permission::find($request['permission_id']);
        $teams = $request['teams_id'];
//        $old_values = $request['old_values'];

        if (in_array('0',$teams)){
            foreach ($request['roles_id'] as $role){
                $role = Role::find($role);
                if ($role){
                    $role->attachPermission($permission,null);
                }
            }
        }
        else{
            foreach ($teams as $team){
                foreach ($request['roles_id'] as $role){
                    $role = Role::find($role);
                    if ($role){
                        $role->attachPermission($permission,$team);
                    }
                }
            }
        }

        return back_normal($request);
    }
    public function assign_role_to_user(Request $request){
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::find($request['user_id']);
        $role = Role::find($request['role_id']);
        $user->attachRole($role);

        $user->ability(['assign'],null);

        return back_normal($request);
    }

    public function teams_list_update(Request $request)
    {
        $jde = json_decode($request->sortval, true);
        NesatableUpdateSort(0, $jde);

        $message =trans("messages.item_created",['item'=>trans('messages.team_sorted')]);
        return back_normal($request,"ok");
    }
}

