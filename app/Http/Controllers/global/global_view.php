<?php

namespace App\Http\Controllers\global;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class global_view extends Controller
{
    public function index()
    {
        return view('global.index');
    }

}
