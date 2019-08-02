<?php

namespace App\Http\Controllers\globals;

use App\charity_payment_patern;
use App\gateway;
use App\setting_transportation;
use App\store;
use App\store_product;
use App\store_product_inventory;
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

        $products = store_product_inventory_size::where('count', '>', '1')->get();
        $productsInv = store_product_inventory::all();
        return view('global.store.store', compact('products', 'productsInv'));
    }

    public function detail_product(Request $request)
    {
        $proInfo = store_product::find($request['pro_id']);
        return view('global.store.details', compact('proInfo'));
    }

    public function store_cart()
    {
        return view('global.store.cart');
    }

    public function store_order()
    {
        $tran = setting_transportation::where('status', "active")->get();
        return view('global.store.order', compact('tran'));
    }

    public function store_payment()
    {
        $tran = setting_transportation::where('status', "active")->get();

        return view('global.store.payment', compact('tran'));

    }

    public function vow(Request $request)
    {
        $charity = charity_payment_patern::with('fields')->find($request['id']);
        $gateways = gateway::with('bank')->where('online', 1)->get();
        return view('global.vows.vow', compact('charity','gateways'));
    }

}
