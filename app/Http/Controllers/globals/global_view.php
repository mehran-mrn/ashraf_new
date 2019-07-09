<?php

namespace App\Http\Controllers\globals;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class global_view extends Controller
{
    public function index()
    {
        return view('global.index');
    }

    public function register_form()
    {
        return view('global.materials.register');
    }
    public function register_form_store(Request $request)
    {
        return response()->json($request);
    }

    public function login_form()
    {
        return view(('global.materials.loginP'));
    }

    public function register_page()
    {
        return view('global.materials.register_page');
    }

    public function login_page()
    {
        return view('global.materials.login_page');
    }

    public function profile_page()
    {
        Artisan::call("cache:clear");
        return view('global.profile');
    }
    public function change_password()
    {
        return view('global.materials.change_password');
    }
    public function edit_information()
    {
        $userInfo = User::find(Auth::id());
        return view('global.materials.edit_information',compact('userInfo'));
    }
}
