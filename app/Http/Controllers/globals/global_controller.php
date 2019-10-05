<?php

namespace App\Http\Controllers\globals;

use App\champion_transaction;
use App\charity_champion;
use App\Events\userRegister;
use App\Events\userRegisterEvent;
use App\person;
use App\users_address;
use Carbon\Carbon;
use Validator;
use App\charity_period;
use App\charity_periods_transaction;
use App\city;
use App\store_product;
use App\store_product_inventory;
use App\store_product_inventory_size;
use App\User;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class global_controller extends Controller
{

    public function register_form_store(Request $request)
    {
        $this->validate($request, [
            'phone_email' => 'required|unique:users,phone|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
        $email = null;
        $phone = null;
        $is_email = filter_var($request->phone_email, FILTER_VALIDATE_EMAIL);
        if ($is_email) {
            $this->validate($request, [
                'phone_email' => 'required|unique:users,email',
            ]);
            $email = $request->phone_email;
        } else {
            $this->validate($request, [
                'phone_email' => 'required|numeric|regex:/(09)[0-9]{9}/'
            ]);
            $phone = $request->phone_email;
        }
        $user = User::create([
            'email' => $email,
            'phone' => $phone,
            'disabled' => 1,
            'password' => bcrypt($request->password),
        ]);
        event(new userRegisterEvent($user));
        $message = trans("messages.user_created");
        return back_normal($request, $message);
    }

    public function reset_password(Request $request)
    {
        return $this->check_email_exists($request);
    }

    public function check_email(Request $request)
    {
        $email = null;
        $phone = null;
        $is_email = filter_var($request->phone_email, FILTER_VALIDATE_EMAIL);
        if ($is_email) {
            $email = $request->phone_email;
        } else {
            $phone = $request->phone_email;
        }
        if ((User::where('email', $email)->exists() and $email) || (User::where('phone', $phone)->exists() and $phone)) {
            return 'false';
        }

        return 'true';

    }

    public function check_email_exists(Request $request)
    {
        $email = null;
        $phone = null;
        $is_email = filter_var($request->phone_email, FILTER_VALIDATE_EMAIL);
        if ($is_email) {
            $email = $request->phone_email;
        } else {
            $phone = $request->phone_email;
        }
        if ((User::where('email', $email)->exists() and $email) || (User::where('phone', $phone)->exists() and $phone)) {
            $check = true;
        } else {
            $check = false;
        }
        if ($check) {
            return view('auth.passwords.reset');
        }

    }

    public function login(Request $request)
    {
        back_normal($request);
    }

    public function update_information(Request $request)
    {
        dd($request->all());

    }

    public function update_password(Request $request)
    {

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::find(Auth::id());
        if (Hash::check($request['old_password'], $user->password)) {
            $user->password = Hash::make($request['password']);;
            $user->save();
            $message = trans("messages.password_changed");
            return back_normal($request, $message);
        } else {
            $message[] = trans("messages.current_password_invalid");
            return back_error($request, $message);
        }

    }

    public function product_size_info(Request $request)
    {

        $info = store_product_inventory_size::find($request['size_id']);
        return json_encode($info);
    }


    //start cart actions
    public function add_to_cart(Request $request)
    {

        $inventory_id = 0;
        $inventory_size_id = 0;
        $count = 1;
        $product = store_product::find($request['pro_id']);
        $price = $product['price'];
        $off = $product['off'];
        $extra_title = "";
        $time = $product['ready'];
        if (isset($request['inventory_id']) && $request['inventory_id'] != 0) {
            $inventory = store_product_inventory::find($request['inventory_id']);
            $price = $inventory['price'];
            $off = $inventory['off'];
            $inventory_id = $request['inventory_id'];
            $extra_title = $inventory['color_code'];
        }
        if (isset($request['inventory_size_id']) && $request['inventory_size_id'] != 0) {
            $inventory_size = store_product_inventory_size::find($request['inventory_size_id']);
            $price = $inventory_size['price'];
            $off = $inventory_size['off'];
            $inventory_size_id = $request['inventory_size_id'];
            $extra_title = $inventory_size['size'];

        }
        if (isset($request['count'])) {
            $count = $request['count'];
        }
        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $request['pro_id'] . $inventory_id . $inventory_size_id => [
                    "title" => $product['title'] . " " . $extra_title,
                    "product_id" => $product['id'],
                    "inventory_id" => $inventory_id,
                    "inventory_size_id" => $inventory_size_id,
                    "price" => $price,
                    "off" => $off,
                    "count" => $count,
                    "photo" => $product['main_image'],
                    'time' => $time
                ]
            ];
            session()->put('cart', $cart);
            $message = trans('messages.product_added_successfully');
            return back_normal($request, $message);
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$request['pro_id'] . $inventory_id . $inventory_size_id])) {

            $cart[$request['pro_id'] . $inventory_id . $inventory_size_id]['count']++;

            session()->put('cart', $cart);

            $message = trans('messages.product_added_successfully');
            return back_normal($request, $message);

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$request['pro_id'] . $inventory_id . $inventory_size_id] = [
            "title" => $product['title'] . " " . $extra_title,
            "product_id" => $product['id'],
            "inventory_id" => $inventory_id,
            "inventory_size_id" => $inventory_size_id,
            "price" => $price,
            "off" => $off,
            "count" => $count,
            "photo" => $product['main_image'],
            'time' => $time
        ];

        session()->put('cart', $cart);

        $message = trans('messages.product_added_successfully');
        return back_normal($request, $message);
    }

    public function cart_update(Request $request)
    {
        if ($request['id'] and $request['count']) {
            $cart = session()->get('cart');

            $cart[$request['id']]["count"] = $request['count'];

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function cart_remove(Request $request)
    {
        if ($request['id']) {

            $cart = session()->get('cart');

            if (isset($cart[$request['id']])) {

                unset($cart[$request['id']]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function add_charity_period(Request $request)
    {
        if (!is_null($request['amount'])) {
            $request['amount'] = str_replace(',', '', $request['amount']);
        }
        $this->validate($request,
            [
                'amount' => 'required|min:10000|max:1000000000|numeric',
                'start_date' => 'required',
                'period' => 'required',
            ]);
        $info = charity_period::create(
            [
                'user_id' => Auth::id(),
                'amount' => $request['amount'],
                'start_date' => shamsi_to_miladi($request['start_date']),
                'next_date' => shamsi_to_miladi($request['start_date']),
                'period' => $request['period'],
                'description' => $request['description'],
            ]
        );

        if (strtotime(shamsi_to_miladi($request['start_date'])) <= time()) {
            charity_periods_transaction::create(
                [
                    'user_id' => Auth::id(),
                    'period_id' => $info['id'],
                    'payment_date' => $info['next_date'],
                    'amount' => $info['amount'],
                    'description' => "پرداخت دوره ای شماره " . $info['id'],
                    'status' => "unpaid",
                ]
            );
            charity_period::where('id', $info['id'])->update(
                [
                    'next_date' => date('Y-m-d', strtotime("+" . $info['period'] . " month", time()))
                ]
            );
        }


        $message = trans("messages.period_created");
        return back_normal($request, ['message' => $message, "code" => 200]);
    }

    public function profile_period_delete(Request $request)
    {
        if ($charity = charity_period::find($request['id'])) {
            if ($charity['user_id'] == Auth::id()) {
                $status = 'active';
                if ($charity['status'] == "active") {
                    $status = 'inactive';
                }
                $charity->status = $status;
                $charity->save();
                $message = trans("messages.period_res", ['item' => __('messages.' . $status)]);
                return back_normal($request, ['message' => $message, "code" => 200]);
            } else {
                $message[] = trans("messages.period_not_found");
                return back_error($request, $message);
            }
        } else {
            $message[] = trans("messages.period_not_found");
            return back_error($request, $message);
        }
    }

    public function profile_period_check()
    {
        $charity = charity_period::where(
            [
                ['status', '=', 'active'],
                ['next_date', '<', date("Y-m-d")]
            ])->get();
        foreach ($charity as $item) {
            $nextDate = strtotime($item['next_date']);
            $now = time();
            if ($now > $nextDate) {
                charity_periods_transaction::create(
                    [
                        'user_id' => $item['user_id'],
                        'period_id' => $item['id'],
                        'payment_date' => $item['next_date'],
                        'amount' => $item['amount'],
                        'description' => "پرداخت دوره ای شماره " . $item['id'],
                        'status' => "unpaid",
                    ]
                );
                charity_period::where('id', $item['id'])->update(
                    [
                        'next_date' => date('Y-m-d', strtotime("+" . $item['period'] . " month", time()))
                    ]
                );
            }
        }
    }

    //end cart actions

    public function get_city_list(Request $request)
    {
        $this->validate($request,
            [
                'proID' => 'required|integer'
            ]);
        $cities = city::where('parent', $request['proID'])->get();
        return response()->json($cities);
    }

    public function store_order_add_address(Request $request)
    {
        $request['mobile'] = latin_num($request['mobile']);
        $request['phone'] = latin_num($request['phone']);

        $this->validate($request,
            [
                'province' => 'required',
                'cities' => 'required',
                'address' => 'required',
                'receiver' => 'required',
            ]
        );
        $address = users_address::create(
            [
                'user_id' => Auth::id(),
                'address' => $request['address'],
                'province_id' => $request['province'],
                'city_id' => $request['cities'],
                'receiver' => $request['receiver'],
                'phone' => $request['phone'],
                'mobile' => $request['mobile'],
                'zip_code' => $request['zip_code'],
                'lat' => $request['lat'],
                'lon' => $request['lon'],
            ]
        );
        users_address::where(
            [
                ['user_id', '=', Auth::id()],
                ['id', '!=', $address['id']],
            ])->update(
            [
                'default' => 0
            ]
        );
        return back_normal($request, ['message' => __("messages.address_added"), 'status' => 200]);
    }

    public function store_order_remove_address(Request $request)
    {
        $address = users_address::findOrFail($request['id']);
        if ($address && $address['user_id'] == Auth::id()) {
            $address->delete();
            $maxAddress = users_address::where('user_id', Auth::id())->max('id');
            users_address::where('id', $maxAddress)->update(['default' => 1]);
            return back_normal($request, ['message' => __("messages.address_deleted"), 'status' => 200]);
        }
    }

    public function champion_payment(Request $request)
    {
        if ($request['amount']) {
            $request['amount'] = intval(str_replace(',', '', $request['amount']));
        }
        $this->validate($request,
            [
                'champion_id' => 'required',
                'amount' => 'required|numeric|between:10000,9000000000|'
            ]);
        if (charity_champion::where('status', 1)->findOrFail($request['champion_id'])) {
            $user_id = 0;
            if (Auth::id()) {
                $user_id = Auth::id();
            }
            $champion = champion_transaction::create(
                [
                    'champion_id' => $request['champion_id'],
                    'amount' => $request['amount'],
                    'user_id' => $user_id,
                    'name' => $request['name'],
                    'last_name' => $request['last_name'],
                    'phone' => $request['phone'],
                    'email' => $request['email'],
                ]
            );
            return back_normal($request, ['message' => __('messages.transaction_created'), 'code' => 200, 'id' => $champion['id']]);
        }
    }


    public function global_profile_completion_upload_image(Request $request)
    {
        uploadGallery($request['file'], "profile", ['category_id' => Auth::id(), 'title' => 'تصویر پروفایل']);
        return redirect()->back();
    }

    public function global_profile_completion_submit(Request $request)
    {


        $con = true;
        if ($request['birthday']) {
            $request['birthday'] = shamsi_to_miladi($request['birthday']);
        }
        if ($request['national_code']) {
            if (!national_code_validation($request['national_code'])) {
                $con = false;
            };
        }
        if ($request['email']) {
            $user = User::find(Auth::id());
            if (!$user->email) {
                $user->email = $request['email'];
                $user->save();
            }
        }
        $message = '';
        if ($con) {
            if ($person = person::where('user_id', '=', Auth::id())->first()) {
                $person->name = $request['name'];
                $person->family = $request['family'];
                $person->national_code = $request['national_code'];
                $person->phone = $request['phone'];
                $person->gender = $request['gender'];
                $person->birth_date = $request['birthday'];
                $person->email = $request['email'];
                $person->save();
                $message = __('messages.item_updated', ['item' => trans('messages.information')]);
            } else {
                person::create(
                    [
                        'parent_id' => Auth::id(),
                        'user_id' => Auth::id(),
                        'name' => $request['name'],
                        'family' => $request['family'],
                        'national_code' => $request['national_code'],
                        'phone' => $request['phone'],
                        'email' => $request['email'],
                        'gender' => $request['gender'],
                        'birth_date' => $request['birthday']
                    ]
                );
                $message = __('messages.item_updated', ['item' => trans('messages.information')]);
            }
            return back_normal($request, ['message' => $message, 'status' => 200]);
        } else {
            $message = __('messages.national_code_invalid');
            return back_error($request, ['message' => $message]);
        }
    }

    public function verify_mobile(Request $request)
    {
        if ($user = User::findOrFail(Auth::id())) {
            $created = new Carbon($user->code_phone_send);
            $now = Carbon::now();
            $diff = $created->diff($now)->i;
            if ($diff < 6) {
                if ($user->code_phone == $request['code']) {
                    $user->phone_verified_at = date("Y-m-d H:i:s");
                    $user->save();
                    return back_normal($request, ['message' => __('messages.phone_verified')]);
                } else {
                    return back_error($request, __('messages.code_invalid'));
                }
            } else {
                return back_error($request, __('messages.timeout'));
            }
        } else {
            return back_error($request, __('messages.user_not_valid'));
        }
    }

    public function verify_email(Request $request)
    {
        if ($user = User::findOrFail(Auth::id())) {
            $created = new Carbon($user->code_email_send);
            $now = Carbon::now();
            $diff = $created->diff($now)->i;
            if ($diff < 6) {
                if ($user->code_email == $request['code']) {
                    $user->email_verified_at = date("Y-m-d H:i:s");
                    $user->save();
                    return back_normal($request, ['message' => __('messages.email_verified')]);
                } else {
                    return back_error($request, __('messages.code_invalid'));
                }
            } else {
                return back_error($request, __('messages.timeout'));
            }
        } else {
            return back_error($request, __('messages.user_not_valid'));
        }
    }

}
