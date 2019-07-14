<?php

namespace App\Http\Controllers\globals;

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
        return view('global.store', compact('products', 'productsInv'));
    }

    public function detail_product(Request $request)
    {
        $proInfo = store_product::find($request['pro_id']);
        return view('global.details', compact('proInfo'));
    }


    public function add_to_cart(Request $request)
    {
        $inventory_id = 0;
        $inventory_size_id = 0;
        $count = 1;
        if (isset($request['inventory_id'])) {
            $inventory_id = $request['inventory_id'];
        }
        if (isset($request['inventory_size_id'])) {
            $inventory_size_id = $request['inventory_size_id'];
        }
        if (isset($request['count'])) {
            $count = $request['count'];
        }
        $product = store_product::find($request['pro_id']);
        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $request['id'] => [
                    "name" => $product['title'],
                    "product_id" => $product['id'],
                    "inventory_id" => $inventory_id,
                    "inventory_size_id" => $inventory_size_id,
                    "count" => $count
                ]
            ];
            session()->put('cart', $cart);
            $message = trans('messages.product_added_successfully');
            return back_normal($request, $message);
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$request['id']])) {

            $cart[$request['id']]['count']++;

            session()->put('cart', $cart);

            $message = trans('messages.product_added_successfully');
            return back_normal($request, $message);

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$request['id']] = [
            "name" => $product['title'],
            "product_id" => $product['id'],
            "inventory_id" => $inventory_id,
            "inventory_size_id" => $inventory_size_id,
            "count" => $count
        ];

        session()->put('cart', $cart);

        $message = trans('messages.product_added_successfully');
        return back_normal($request, $message);
    }

}
