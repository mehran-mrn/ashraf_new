<?php

namespace App\Http\Controllers\panel;

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

        return view('panel.user_manager.users_list');
    }
    public function register_form()
    {
        return view('panel.user_manager.user_register_form');
    }
    public function form_notification()
    {
        return view('panel.materials.form_notification');
    }

}
