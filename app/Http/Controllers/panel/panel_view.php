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
    public function register_form()
    {
        return view('panel.user_manager.user_register_form');
    }
    public function permissions_list()
    {
        $permissions = Permission::all();
        return view('panel.user_manager.permissions_list',compact('permissions'));
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
