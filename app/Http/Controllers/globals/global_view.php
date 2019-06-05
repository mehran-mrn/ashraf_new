<?php

namespace App\Http\Controllers\globals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function login_form_check(Request $request)
    {
        return response()->json($request);

    }

    public function register_page()
    {
        return view('global.materials.register_page');
    }

    public function login_page()
    {
        return view('global.materials.login_page');
    }
}
