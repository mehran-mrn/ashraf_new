<?php

namespace App\Http\Controllers\globals;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $is_email = filter_var( $request->phone_email, FILTER_VALIDATE_EMAIL );
        if ($is_email){
            $this->validate($request, [
                'phone_email' => 'required|unique:users,email',
            ]);
            $email = $request->phone_email;
        }
        else{
            $this->validate($request, [
                'phone_email' => 'required|numeric|regex:/(09)[0-9]{9}/'
            ]);
            $phone = $request->phone_email;
        }


        $user = User::create([
            'email' => $email ,
            'phone' =>  $phone ,
            'disabled' =>  1,
//            'last_modifier' =>  $currentUser->id,
            'password' => bcrypt($request->password),
        ]);
        $message =trans("messages.user_created");
        return back_normal($request,$message);
    }

    public function check_email(Request $request)
    {
        $email = null;
        $phone = null;
        $is_email = filter_var( $request->phone_email, FILTER_VALIDATE_EMAIL );
        if ($is_email){
            $email = $request->phone_email;
        }
        else{
            $phone = $request->phone_email;
        }
        if(User::where('email',$email)->first() || User::where('phone',$phone)->first() ) {
            return 'false';
        }
        else{
            return 'true';
        }
    }

}
