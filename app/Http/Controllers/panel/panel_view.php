<?php

namespace App\Http\Controllers\panel;

use App\Permission;
use App\Role;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class panel_view extends Controller
{
    //
    public function dashboard()
    {
        return view('panel.dashboard');
    }
    public function users_list()
    {
            $users = User::get();
        return view('panel.user_manager.users_list',compact('users'));
    }
    public function permission_assign( $permission_id)
    {
        $users= User::get();
        $permission = Permission::with('users','roles')->find($permission_id);
        return view('panel.user_manager.permission_assign_page',compact('permission','users'));
    }
    public function user_permission_assign( $user_id)
    {
        $user = user::with('permissions','roles')->find($user_id);
        return view('panel.user_manager.user_permission_page',compact('user'));
    }
    public function assign_user_to_permission_form($permission_id)
    {
        $users= User::get();
        return view('panel.user_manager.assign_user_to_permission_form',compact('permission_id','users'));
    }
    public function assign_role_to_permission_form($permission_id)
    {
        $roles= Role::get();
        return view('panel.user_manager.assign_role_to_permission_form',compact('permission_id','roles'));
    }
    public function assign_role_to_user_form($user_id)
    {
        $roles= Role::get();
        return view('panel.user_manager.assign_role_to_user_form',compact('user_id','roles'));
    }
    public function register_form()
    {
        return view('panel.user_manager.user_register_form');
    }
    public function permissions_list()
    {
        $categories = Permission::groupBy('category')->get(['category']);
        $categories_permissions=[];
        foreach ($categories as $category){
            $category_permissions = Permission::where('category',$category['category'])->get();
            $categories_permissions[$category['category']] = $category_permissions;
        }
        return view('panel.user_manager.permissions_list',compact('categories_permissions'));
    }
    public function register_permission_form()
    {
        return view('panel.user_manager.permission_register_form');
    }
    public function roles_list()
    {
        $roles = Role::all();
        return view('panel.user_manager.roles_list',compact('roles'));
    }
    public function register_role_form()
    {
        return view('panel.user_manager.role_register_form');
    }
    public function teams_list()
    {
        $teams = Team::all();
        return view('panel.user_manager.teams_list',compact('teams'));
    }
    public function register_team_form()
    {
        return view('panel.user_manager.team_register_form');
    }

    public function form_notification()
    {
        return view('panel.materials.form_notification');
    }

}
