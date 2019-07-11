<?php

namespace App\Http\Controllers\globals;

use App\store_product_inventory_size;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class global_controller extends Controller
{

    public function register_form_store(Request $request)
    {
//        $currentUser = Auth::user();
        $this->validate($request, [
            'phone_email' => 'required',
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
//            'last_modifier' =>  $currentUser->id,
            'password' => bcrypt($request->password),
        ]);
        $message = trans("messages.user_created");
        return back_normal($request, $message);
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
}
