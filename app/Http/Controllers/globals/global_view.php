<?php

namespace App\Http\Controllers\globals;

use App\blog_slider;
use App\caravan;
use App\champion_transaction;
use App\charity_champion;
use App\charity_payment_patern;
use App\charity_payment_title;
use App\charity_period;
use App\charity_periods_transaction;
use App\charity_transaction;
use App\charity_transactions_value;
use App\city;
use App\gallery_category;
use App\gateway;
use App\media;
use App\setting_transportation;
use App\store_product;
use App\store_product_inventory;
use App\store_product_inventory_size;
use App\transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Larabookir\Gateway\Mellat\Mellat;
use Larabookir\Gateway\Saman\Saman;
use WebDevEtc\BlogEtc\Captcha\UsesCaptcha;
use WebDevEtc\BlogEtc\Middleware\UserCanManageBlogPosts;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;

class global_view extends Controller
{
    use UsesCaptcha;

    public function index()
    {
        $sliders = blog_slider::get();
        $categories = BlogEtcCategory::orderBy("category_name")->get();

        $champions = charity_champion::with('image')->get();
        return view('global.index', compact('sliders', 'categories', 'champions'));
    }

    public function post_page($blogPostSlug, Request $request)
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
        $periods = charity_period::where('user_id', Auth::id())->get();
        $unpaidPeriod = charity_periods_transaction::where(
            [
                ['status', '=', 'unpaid'],
                ['user_id', '=', Auth::id()],
            ])->get();
        return view('global.profile', compact('periods', 'unpaidPeriod'));
    }

    public function caravan_page()
    {
        $active_caravans = caravan::where('duty', \auth()->id())->whereIn('status', ['1', '2', '3', '4'])->get();

        return view('global.profile.caravan', compact('active_caravans', 'caravan_doc'));
    }

    public function involved_projects($id)
    {
//        $project = building_project::find($id);
        $project = null;
        return view('global.profile.building_projects', compact('project'));
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
        $userInfo = User::with('addresses')->findOrFail(Auth::id());
        $provinces = city::where('parent', 0)->get();
        return view('global.store.order', compact('tran', 'userInfo', 'provinces'));
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

        if (!is_null($request['amount'])) {
            $request['amount'] = str_replace(',', '', $request['amount']);
        }
        $patern = charity_payment_patern::find($request['charity_id']);
        $this->validate($request,
            [
                'amount' => 'required|min:' . $patern['min'] . '|max:' . $patern['max'] . '|numeric',
                'gateway' => 'required',
                'email' => 'nullable|email'
            ]);
        $user_id = 0;
        if (Auth::id()) {
            $user_id = Auth::id();
        }
        if (!is_null($patern)) {
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
            if (isset($request['field'])) {
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

    }

    public function vow_cart(Request $request)
    {
        $charityIn = charity_periods_transaction::with('period')->findOrFail($request['id']);
        if ($charityIn['user_id'] == Auth::id()) {
            $gateways = gateway::with('bank')->get();
            return view('global.vows.cart', compact('charityIn', 'gateways'));
        } else {
            return abort(403);
        }
    }

    public function vow_donate()
    {
        $title = charity_payment_title::get();
        $patern = charity_payment_patern::find(2);
        $gateways = gateway::with('bank')->where('online', 1)->get();
        return view('global.vows.donate', compact('title', 'patern', 'gateways'));
    }

    public function vow_period()
    {
        $patern = charity_payment_patern::find(1);
        return view('global.vows.period', compact('patern'));
    }

    public function gallery()
    {
        $medias = gallery_category::where('status', 'active')->with('media', 'media_one', 'media_two')->get();
        return view('global.gallery', compact('medias'));
    }

    public function gallery_view(Request $request)
    {
        $pics = media::where(
            [
                ['category_id', '=', $request['id']],
                ['thumbnail_size', '=', null],
            ])->get();
        $categoryInfo = gallery_category::find($request['id']);
        return view('global.gallery.gallery_view', compact('pics', 'categoryInfo'));
    }

    public function blog($category_slug = null)
    {
        $this->middleware(UserCanManageBlogPosts::class);

        if ($category_slug) {
            $category = BlogEtcCategory::where("slug", $category_slug)->firstOrFail();
            $posts = $category->posts()->where("blog_etc_post_categories.blog_etc_category_id", $category->id);
        } else {
            $posts = BlogEtcPost::query();
        }

//        $posts = $posts->orderBy("posted_at", "desc")
//            ->paginate(config("blogetc.per_page", 10));


        $posts = BlogEtcPost::orderBy("posted_at", "desc")
            ->paginate(10);
        return view("global.blog", ['posts' => $posts]);

        return view('global.blog', compact('posts'));
    }

    public function payment(Request $request)
    {
        return $request['type'];
        $this->validate($request,
            [
                'type' => 'required',
                'id' => 'required|int'
            ]);
        $con = true;
        $vow = array('charity_vow', 'charity_donate');
        if (in_array($request['type'], $vow)) {
            $info = charity_transaction::findOrFail($request['id']);
        } elseif ($request['type'] == "charity_period") {
            $info = charity_periods_transaction::findOrFail($request['id']);
            if ($info['user_id']) {
                if ($info['user_id'] != Auth::id() || $info['status'] != "unpaid") {
                    $con = false;
                }
            }
        } elseif ($request['type'] == "charity_champion") {
            $info = champion_transaction::findOrFail($request['id']);
        }
        if (!is_null($info) && $con) {
            $gatewayInfo = gateway::findOrFail($request['gateway_id']);
            if ($gatewayInfo['function_name'] == "SamanGateway") {
                try {
                    $gateway = \Larabookir\Gateway\Gateway::make(new Saman());
                    $gateway->setCallback(route('callback', ['gateway' => 'saman']));
                    $gateway->price($info['amount'])->moduleSet($request['type'])->moduleIDSet($info['id'])->ready();
                    $refId = $gateway->refId();
                    $transID = $gateway->transactionId();

                    $info->trans_id = $transID;
                    $info->gateway_id = $gatewayInfo['id'];
                    $info->save();
                    return $gateway->redirect();

                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            } elseif ($gatewayInfo['function_name'] == "MellatGateway") {
                try {
                    $gateway = \Larabookir\Gateway\Gateway::make(new Mellat());
                    $gateway->setCallback(route('callback', ['gateway' => 'mellat']));
                    $gateway->price($info['amount'])->moduleSet($request['type'])->moduleIDSet($info['id'])->ready();
                    $refId = $gateway->refId();
                    $transID = $gateway->transactionId();

                    $info->trans_id = $transID;
                    $info->gateway_id = $gatewayInfo['id'];
                    $info->save();
                    return $gateway->redirect();

                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            return back_normal($request, ['message' => trans('errors.payment_not_valid')]);
        }
    }


    public function callback(Request $request)
    {
        try {
            $gateway = \Larabookir\Gateway\Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
            $module = $gateway->module();
            $moduleID = $gateway->moduleID();

            return $moduleID;
        } catch (\Larabookir\Gateway\Exceptions\RetryException $e) {
            $messages['message'] = $e->getMessage();
            $messages['result'] = "repeat";
            return view('global.callback', compact('messages'));
        } catch (\Exception $e) {
            $gateway = config('gateway.table', 'gateway_transactions');
            $data = \DB::table($gateway)->find($request['transaction_id']);
            if ($data->module == "charity_donate" || $data->module == "charity_vow") {
                $charity = charity_transaction::findOrFail($data->module_id);
                $charity->status = 'fail';
                $charity->payment_date = date("Y-m-d H:i:s", time());
                $charity->save();
            }
            $messages['message'] = $e->getMessage();
            $messages['result'] = "fail";
            return view('global.callback', compact('messages'));
        }
    }

    public function champion_show($id)
    {
        $champion = charity_champion::with('image', 'projects', 'transaction')->findOrFail($id);
        $champions = charity_champion::with('image')->orderBy('created_at', 'desc')->limit(3)->get();

        return view('global.champion.champion', compact('champion', 'champions'));
    }

    public function champion_cart($id)
    {
        $champion = champion_transaction::with('champion')->findOrFail($id);
        $gateways = gateway::with('bank')->where('online', 1)->get();
        return view('global.champion.cart', compact('champion', 'gateways'));
    }
}
