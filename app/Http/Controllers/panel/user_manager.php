<?php

namespace App\Http\Controllers\panel;

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
}
