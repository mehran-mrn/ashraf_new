<?php

namespace App\Http\Controllers\globals;

use App\bank;
use App\blog_slider;
use App\charity_payment_patern;
use App\charity_payment_title;
use App\charity_transaction;
use App\charity_transactions_value;
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
use Swis\LaravelFulltext\Search;
use WebDevEtc\BlogEtc\Captcha\UsesCaptcha;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;
class global_view extends Controller
{
    use UsesCaptcha;

    public function index()
    {
        $sliders = blog_slider::get();
        return view('global.index',compact('sliders'));
    }

    public function post_page($blogPostSlug,Request $request)
    {
        $blog_post = BlogEtcPost::where("slug", $blogPostSlug)
            ->firstOrFail();;

        if ($captcha = $this->getCaptchaObject()) {
            $captcha->runCaptchaBeforeShowingPosts($request, $blog_post);
        }

        return view('global.post', [
            'post' => $blog_post,
            // the default scope only selects approved comments, ordered by id
            'comments' => $blog_post->comments()
                ->with("user")
                ->get(),
            'captcha' => $captcha,
        ]);
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

    public function vow_view(Request $request)
    {
        $charity = charity_payment_patern::with('fields')->find($request['id']);
        $gateways = gateway::with('bank')->where('online', 1)->get();
        return view('global.vows.vow', compact('charity', 'gateways'));
    }

    public function vow_payment(Request $request)
    {
        $this->validate($request,
            [
                'amount' => 'required',
                'gateway' => 'required',
                'email' => 'email'
            ]);
        $user_id = 0;
        if (Auth::id()) {
            $user_id = Auth::id();
        }
        if (charity_payment_patern::find($request['charity_id'])) {
            $trans = new charity_transaction();
            $trans->user_id = $user_id OR null;
            $trans->charity_id = $request['charity_id'] OR null;
            $trans->charity_field_id = $request['charity_id'] OR null;
            $trans->name = $request['name'] OR null;
            $trans->phone = $request['phone'] OR null;
            $trans->email = $request['email'] OR null;
            $trans->title_id = $request['title'] OR null;
            $trans->description = $request['description'] OR null;
            $trans->amount = $request['amount'] OR null;
            $trans->gateway_id = $request['gateway'] OR null;
            $trans->status = 'pending';
            $trans->save();
            $transInfo = $trans->id;
            if(isset($request['field'])) {
                foreach ($request['field'] as $item => $value) {
                    if ($value != "") {
                        charity_transactions_value::create(
                            [
                                'trans_id' => $transInfo,
                                'field_id' => $item,
                                'value' => $value
                            ]
                        );
                    }
                }
            }
            $message = trans("messages.transaction_created");
            return back_normal($request, ['message' => $message, "code" => 200, 'id' => $transInfo]);

        } else {
            $message = trans("messages.error");
            return back_normal($request, ['message' => $message, 'code' => 201]);
        }
        $message = trans("messages.error2");
        return back_normal($request, ['message' => $message, 'code' => 202]);
    }

    public function vow_cart(Request $request)
    {
        $charityIn = charity_transaction::with('values')->find($request['id'])->with('charity_field');
        return view('global.vows.vow_cart', compact('charityIn'));
    }

    public function vow_donate()
    {
        $title = charity_payment_title::get();
        $patern = charity_payment_patern::find(2);
        $gateways = gateway::with('bank')->where('online', 1)->get();
        return view('global.vows.donate', compact('title', 'patern', 'gateways'));
    }

}
