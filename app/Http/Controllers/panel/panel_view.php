<?php

namespace App\Http\Controllers\panel;

use App\caravan_host;
use App\category;
use App\city;
use App\Permission;
use App\Role;
use App\Team;
use App\User;
use App\caravan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Laratrust\Models\LaratrustPermission;
use Laratrust\Models\LaratrustRole;

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
        return view('panel.user_manager.users_list', compact('users'));
    }

    public function permission_assign($permission_id)
    {
        $users = User::get();
        $permission = Permission::with('users', 'roles')->find($permission_id);
        $teams_roles = [];
        $teamForeignKey = Config::get('laratrust.foreign_keys.team');
        foreach ($permission['roles'] as $role) {
            $teams_roles[$role['pivot'][$teamForeignKey]][] = $role;
        }
        return view('panel.user_manager.permission_assign_page', compact('permission', 'users', 'teams_roles'));
    }

    public function user_permission_assign($user_id)
    {
        $user = user::with('permissions', 'roles')->find($user_id);
        $checked_permissions =[];
        foreach ($user['permissions'] as $permission){
            $checked_permissions[]=$permission['id'];
        }
        $categories = Permission::groupBy('category')->get(['category']);
        $categories_permissions = [];
        foreach ($categories as $category) {
            $category_permissions = Permission::where('category', $category['category'])->get();
            $categories_permissions[$category['category']] = $category_permissions;
        }

        return view('panel.user_manager.user_permission_page', compact('user','categories_permissions','checked_permissions'));
    }

    public function assign_user_to_permission_form($permission_id)
    {
        $users = User::get();
        return view('panel.user_manager.assign_user_to_permission_form', compact('permission_id', 'users'));
    }

    public function assign_role_to_permission_form($permission_id,$old=null,$team_id = null)
    {
        $roles = Role::get();
        $teams = Team::all();
        $checked_roles=[];
        $current_roles = Permission::with('roles')->find($permission_id);
        $checked_team = null;
        $old_team = [];
        if ($old and !empty($current_roles['roles'])){
            $checked_team= (empty($team_id) ? "0" : $team_id);
            foreach ($current_roles['roles'] as $current_role){

                if ($current_role['pivot'][Config::get('laratrust.foreign_keys.team')] == $team_id){
                    $checked_roles[]= $current_role['id'];
                    $old_team[] = $team_id."-".$current_role['id'];

                }
            }
        }
        return view('panel.user_manager.assign_role_to_permission_form', compact('permission_id', 'roles', 'teams', 'checked_roles', 'checked_team','old_team'));
    }

    public function assign_role_to_user_form($user_id)
    {
        $roles = Role::get();
        $user = user::with('permissions', 'roles')->find($user_id);
        $checked_roles=[];

        foreach ($user['roles']as $role){
            $checked_roles[]=$role['id'];
        }
        return view('panel.user_manager.assign_role_to_user_form', compact('user_id', 'roles','checked_roles'));
    }

    public function register_form()
    {
        return view('panel.user_manager.user_register_form');
    }

    public function permissions_list()
    {
        $categories = Permission::groupBy('category')->get(['category']);
        $categories_permissions = [];
        foreach ($categories as $category) {
            $category_permissions = Permission::where('category', $category['category'])->get();
            $categories_permissions[$category['category']] = $category_permissions;
        }
        return view('panel.user_manager.permissions_list', compact('categories_permissions'));
    }

    public function register_permission_form()
    {
        return view('panel.user_manager.permission_register_form');
    }

    public function roles_list()
    {
        $roles = Role::all();
        return view('panel.user_manager.roles_list', compact('roles'));
    }

    public function register_role_form()
    {
        return view('panel.user_manager.role_register_form');
    }

    public function teams_list()
    {
        $teams = Team::all();
        return view('panel.user_manager.teams_list', compact('teams'));
    }

    public function register_team_form()
    {
        return view('panel.user_manager.team_register_form');
    }

    public function form_notification()
    {
        return view('panel.materials.form_notification');
    }


    public function permissions_team_list(Request $request)
    {
        $permissionRoles = Permission::with('roles')->find(1);
        $teams_roles = [];
        $teamForeignKey = Config::get('laratrust.foreign_keys.team');
        foreach ($permissionRoles['roles'] as $role) {
            if ($request->team_id == $role['pivot']['team_id']) {
                $teams_roles[$role['pivot'][$teamForeignKey]][] = $role;
            }

        }
        return view('panel.user_manager.teams_list_permissions',compact('teams_roles'));
    }
//end users module

//blog module
    public function add_post()
    {
        $cats = category::all();
        return view('panel.blog.add_post',compact('cats'));
    }

    public function post_list()
    {
        $posts = \App\blog::with('blog_categories.category')->get();
        return view('panel.blog.post_list',compact('posts'));
    }

    public function category()
    {
        $cats = category::all();

        return view('panel.blog.category',compact('cats'));
    }
    public function category_add_form()
    {
        return view('panel.blog.add_category');
    }
//end blog module


//caravan module
    public function caravan_dashboard()
    {
        return view('panel.caravan.dashboard');
    }

    public function hosts_list()
    {
        $hosts = caravan_host::with('media')->get();

        return view('panel.caravan.hosts_list',compact('hosts'));
    }

    public function load_host_form($host_id = null)
    {
        if ($host_id){
            $host = caravan_host::find($host_id);
        }
        else{
            $host = null;
        }
        return view('panel.caravan.materials.add_new_host_form', compact('host'));
    }

    public function add_caravan_page($caravan_id = null)
    {
        if ($caravan_id){
            $caravan = caravan::find($caravan_id);
        }
        else{
            $caravan = null;
        }

        $caravan_hosts = caravan_host::get();
        $users = User::get();
        return view('panel.caravan.add_caravan_page',compact('caravan','caravan_hosts','users'));
    }

    public function caravans_list()
    {
        $caravans = caravan::get();
        return view('panel.caravan.caravans_list',compact('caravans'));
    }
    public function caravan($caravan_id)
    {
        $caravan = caravan::with('host')->find($caravan_id);
        return view('panel.caravan.view_caravan',compact('caravan'));
    }
//end caravan module


//setting module
    public function cities_list()
    {
        $cities = city::where('parent','0')->orderBy('name')->paginate(32);
        return view('panel.setting.cities_list',compact('cities'));
    }
//end setting module

}
