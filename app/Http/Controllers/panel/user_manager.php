<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class user_manager extends Controller
{
    //
    public function register(Request $request)
    {
        return response()->json(['message' => trans('messages.parameter_remove_successfully')]);
        $this->validate($request, [
            'username' => 'required_without_all:email,phone',
            'email' => 'required_without_all:username,phone',
            'phone' => 'required_without_all:username,email',
            'password' => 'required|confirmed|min:6',
        ]);

    }
}
