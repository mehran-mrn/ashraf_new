<?php

namespace App\Http\Controllers\panel;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class user_manager extends Controller
{
    //
    public function register(Request $request)
    {
//        $currentUser = Auth::user();
        $this->validate($request, [
            'username' => 'required_without_all:email,phone|nullable|unique:users,name',
            'email' => 'required_without_all:username,phone|nullable|unique:users',
            'phone' => 'required_without_all:username,email|nullable|numeric|regex:/(09)[0-9]{9}/|unique:users',
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
            'name' => 'required|unique:permissions',
            'display_name' => 'required|unique:permissions',
        ]);

        $user = Permission::create([
            'name' => $request->name ,
            'display_name' => $request->display_name ,
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

        $user = Role::create([
            'name' => $request->name ,
            'display_name' => $request->display_name ,
            'description' =>  $request->description ,
        ]);
        $message =trans("messages.item_created",['item'=>trans('messages.role')]);
        return back_normal($request,$message);
    }

}
