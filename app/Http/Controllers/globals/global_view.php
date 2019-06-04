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

}
