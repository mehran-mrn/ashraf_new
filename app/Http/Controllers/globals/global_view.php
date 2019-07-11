<?php

namespace App\Http\Controllers\globals;

use App\store;
use App\store_product;
use App\store_product_inventory_size;
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
        return view('global.materials.edit_information', compact('userInfo'));
    }

    public function shop_page()
    {

        $products = store_product_inventory_size::where('count','>','1')->get();
//        $products = store_product::all();
        return view('global.store', compact('products'));
    }

    public function detail_product(Request $request)
    {
        $proInfo = store_product::find($request['pro_id']);
        return view('global.details',compact('proInfo'));
    }
}
