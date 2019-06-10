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

        if (isset($request['old_team'])){
            foreach ($request['old_team'] as  $value){
                $team_role = explode('-',$value);
                $team_id = $team_role[0];
                $role_id = $team_role[1];

                $old_role = Role::find($role_id);
                if ($old_role){
                    $old_role->detachPermission($permission,($team_id?$team_id:null));
                }
            }
        }

        if (in_array('0',$teams)){

            foreach ($request['roles_id'] as $role_id){
                $role = Role::find($role_id);
                if ($role){
                    $role->detachPermission($permission);
                    $role->attachPermission($permission);
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
            'roles_id' => 'required',
        ]);
        $user = User::find($request['user_id']);
        $all_roles = Role::pluck('id')->toArray();
        $detached_roles = array_diff($all_roles,$request['roles_id']);
        $user->detachRoles($detached_roles);
        foreach ($request['roles_id'] as $role_id){
            $role = Role::find($role_id);
            $user->attachRole($role);
        }
        return back_normal($request);
    }
    public function assign_permission_to_user(Request $request){
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'permissions_id' => 'required',
        ]);
        $user = User::find($request['user_id']);
        $all_permissions = Permission::pluck('id')->toArray();
        $detached_permissions = array_diff($all_permissions,$request['permissions_id']);
        $user->detachPermissions($detached_permissions);
        foreach ($request['permissions_id'] as $permission_id){
            $Permission = Permission::find($permission_id);
            $user->attachPermission($Permission);
        }
        return back_normal($request);
    }
    public function teams_list_update(Request $request)
    {
        $jde = json_decode($request->sortval, true);
        NesatableUpdateSort(0, $jde);

        $message =trans("messages.item_created",['item'=>trans('messages.team_sorted')]);
        return back_normal($request,"ok");
    }
    public function delete_role_from_permission($permission_id , $team_id =null ,Request $request)
    {
        $permission = Permission::with('roles')->find($permission_id);
        if (!empty($permission['roles'])){
            foreach ($permission['roles'] as $role){
                if ($role['pivot'][Config::get('laratrust.foreign_keys.team')] == $team_id){
                    $role->detachPermission($permission,$team_id);
                }
            }
        }
        return back_normal($request);

    }
    public function delete_user_from_permission($permission_id , $user_id ,Request $request)
    {
        $permission = Permission::find($permission_id);
        $user = User::find($user_id);
        $user->detachPermission($permission);
        return back_normal($request);

    }
    public function delete_role_from_user($role_id , $user_id ,Request $request)
    {
        $role = Role::find($role_id);
        $user = User::find($user_id);
        $user->detachRole($role);
        return back_normal($request);

    }
}

