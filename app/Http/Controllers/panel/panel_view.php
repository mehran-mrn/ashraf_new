<?php

namespace App\Http\Controllers\panel;

use App\bank;
use App\blog;
use App\blog_categories;
use App\caravan_host;
use App\category;
use App\city;
use App\gateway;
use App\Permission;
use App\person;
use App\product_category;
use App\person_caravan;
use App\Role;
use App\store_category;
use App\store_discount_code;
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
        $checked_permissions = [];
        foreach ($user['permissions'] as $permission) {
            $checked_permissions[] = $permission['id'];
        }
        $categories = Permission::groupBy('category')->get(['category']);
        $categories_permissions = [];
        foreach ($categories as $category) {
            $category_permissions = Permission::where('category', $category['category'])->get();
            $categories_permissions[$category['category']] = $category_permissions;
        }

        return view('panel.user_manager.user_permission_page', compact('user', 'categories_permissions', 'checked_permissions'));
    }

    public function assign_user_to_permission_form($permission_id)
    {
        $users = User::get();
        return view('panel.user_manager.assign_user_to_permission_form', compact('permission_id', 'users'));
    }

    public function assign_role_to_permission_form($permission_id, $old = null, $team_id = null)
    {
        $roles = Role::get();
        $teams = Team::all();
        $checked_roles = [];
        $current_roles = Permission::with('roles')->find($permission_id);
        $checked_team = null;
        $old_team = [];
        if ($old and !empty($current_roles['roles'])) {
            $checked_team = (empty($team_id) ? "0" : $team_id);
            foreach ($current_roles['roles'] as $current_role) {

                if ($current_role['pivot'][Config::get('laratrust.foreign_keys.team')] == $team_id) {
                    $checked_roles[] = $current_role['id'];
                    $old_team[] = $team_id . "-" . $current_role['id'];

                }
            }
        }
        return view('panel.user_manager.assign_role_to_permission_form', compact('permission_id', 'roles', 'teams', 'checked_roles', 'checked_team', 'old_team'));
    }

    public function assign_role_to_user_form($user_id)
    {
        $roles = Role::get();
        $user = user::with('permissions', 'roles')->find($user_id);
        $checked_roles = [];

        foreach ($user['roles'] as $role) {
            $checked_roles[] = $role['id'];
        }
        return view('panel.user_manager.assign_role_to_user_form', compact('user_id', 'roles', 'checked_roles'));
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
        return view('panel.user_manager.teams_list_permissions', compact('teams_roles'));
    }
//end users module

//blog module
    public function post_add()
    {
        $cats = category::all();
        return view('panel.blog.post_add', compact('cats'));
    }

    public function post_list()
    {
        $posts = \App\blog::with('blog_categories.category')->get();
        $postCount = blog::count();
        return view('panel.blog.post_list', compact('posts', 'postCount'));
    }

    public function post_edit_form(Request $request)
    {

        $post = \App\blog::with(['blog_categories.category', 'blog_tag'])->find($request['post_id']);
        $cats = category::all();
        return view('panel.blog.post_edit', compact('post', 'cats'));
    }

    public function category_list()
    {
        $cats = category::all();
        return view('panel.blog.category_list', compact('cats'));
    }

    public function category_add_form()
    {
        return view('panel.blog.category_add');
    }

    public function category_edit_form(Request $request)
    {
        $cat_info = category::find($request['cat_id']);
        return view('panel.blog.category_edit', compact('cat_info'));
    }
//end blog module


//caravan module
    public function caravan_dashboard()
    {
        $caravans_query = caravan::query();
        $caravans_query->whereIn('status', [1, 2, 3,4]);
        $caravans = $caravans_query->get();
        return view('panel.caravan.dashboard',compact('caravans'));
    }

    public function hosts_list()
    {
        $hosts = caravan_host::with('media')->get();

        return view('panel.caravan.hosts_list', compact('hosts'));
    }

    public function load_host_form($host_id = null)
    {
        if ($host_id) {
            $host = caravan_host::find($host_id);
        } else {
            $host = null;
        }
        return view('panel.caravan.materials.add_new_host_form', compact('host'));
    }

    public function add_caravan_page($caravan_id = null)
    {
        if ($caravan_id) {
            $caravan = caravan::find($caravan_id);
        } else {
            $caravan = null;
        }

        $caravan_hosts = caravan_host::get();
        $users = User::get();
        return view('panel.caravan.add_caravan_page', compact('caravan', 'caravan_hosts', 'users'));
    }

    public function caravans_list(Request $request)
    {
        $caravans_query = caravan::query();

        $status_array = $request->input('status');

        if (is_array($status_array)){
            foreach ($status_array as $status){
                $caravans_query->where('status',$status);
            }
        }
        elseif (is_numeric($status_array)){
            $caravans_query->where('status',$status_array);
        }
        $caravans = $caravans_query->get();
        return view('panel.caravan.caravans_list', compact('caravans'));
    }

    public function caravan($caravan_id)
    {
        $caravan = caravan::with('host', 'workflow', 'persons.person')->find($caravan_id);
        return view('panel.caravan.view_caravan', compact('caravan'));
    }

    public function register_to_caravan($caravan_id,$person_caravan_id =null)
    {
        $caravan = caravan::find($caravan_id);
        $person_caravan = null;
        if (!empty($person_caravan_id)){
            $person_caravan = person_caravan::with('person')->find($person_caravan_id);
        }
        return view('panel.caravan.register_to_caravan_form', compact('caravan','person_caravan'));
    }

    public function register_to_caravan_post(Request $request)
    {
        $this->validate($request, [
            'caravan_id' => 'required',
            'national_code' => 'required',
        ]);
        $national_validate = national_code_validation($request['national_code']);
        if (!$national_validate) {
            $errors[] = trans('messages.national_code_error');
            return back_error($request, $errors);
        }
        $caravan = caravan::find($request['caravan_id']);
        $national_code = $request['national_code'];
        $person = person::where('national_code', $national_code)->first();

        return view('panel.caravan.register_to_caravan_form', compact('caravan', 'national_code', 'person'));
    }

    public function change_caravan_status_form($caravan_id,$status)
    {
        //$status "back" "next" "cancel"
        $caravan = caravan::find($caravan_id);
        return view('panel.caravan.materials.change_caravan_status', compact('caravan','status'));
    }

    public function caravans_echart_data()
    {
        $hosts = caravan_host::get();
        $now_date = date('Y-m-d H:i:s');
        $start_date = date('Y-m-d H:i:s', strtotime('-1 years'));
        $first_date = $start_date;
        $this_end = $start_date;
        $info=[];
        foreach ($hosts as $host){
            $host_count = caravan::where('caravan_host_id',$host['id'])->whereBetween('start',[$first_date,$now_date])->where('status','5')->count();
//            if ($host_count>0) {
                for ($i = 1; $i <= 12; $i++) {
                    $this_start = $this_end;
                    $this_end = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($this_start)));
                    $caravans_count = caravan::where('caravan_host_id', $host['id'])->whereBetween('start', [$this_start, $this_end])->where('status', '5')->count();
                    $info[$host['name']][jdate('Y F',strtotime($this_start))] = $caravans_count;
//                }
            }
        }
//        return response()->json($info);
        return $info;
    }


//end caravan module


//setting module
    public function cities_list()
    {
        $cities = city::where('parent', '0')->orderBy('name')->paginate(32);
        return view('panel.setting.cities_list', compact('cities'));
    }

    public function gateway_setting()
    {
        $gateways = gateway::get();
        return view('panel.setting.gateway_setting', compact('gateways'));
    }

    public function gateway_add()
    {
        $banks = bank::groupBy('name')->get();
        return view('panel.setting.gateway_add', compact('banks'));
    }

//end setting module

//store module
    public function product_add()
    {
        return view('panel.store.product_add');
    }
    public function product_list()
    {
        dd(store_category::all());

        return view('panel.store.product_list');
    }

    public function discount_code()
    {
        $codes = store_discount_code::get();
        return view('panel.store.discount_code',compact('codes'));
    }
    public function discount_add_form()
    {
        return view('panel.store.discount.discount_add_form');
    }
    public function discount_code_edit_form(Request $request)
    {
        $dis_info = store_discount_code::find($request['dis_id']);
        return view('panel.store.discount.discount_edit_form',compact('dis_info'));
    }

    public function manage_orders()
    {
        return view('panel.store.manage_orders');
    }
    public function store_setting()
    {
        return view('panel.store.store_setting');
    }

    public function store_category()
    {

        $product_categories = store_category::get();
        return view('panel.store.store_category',compact('product_categories'));
    }
    public function store_category_add()
    {
        return view('panel.store.category.store_category_add');
    }

    public function store_category_edit_form(Request $request)
    {
        $cat_info = store_category::find($request['cat_id']);
        return view('panel.store.category.store_category_edit',compact('cat_info'));
    }
//end store module

}
