<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();

    }
    public function findUsername()
    {
        $login = request()->input('name');

        if(filter_var($login, FILTER_VALIDATE_EMAIL)){
            $fieldType = 'email';
        }
        elseif (preg_match('/^((09)|(\+989)|(9))([0-9]{9})/', $login)){
            $fieldType = 'phone';
        }
        else{
            $fieldType = 'name';
        }

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
    public function username()
    {
//        $login = request()->input('login');
//        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
//        request()->merge([$field => $login]);
//        return $field;
        return $this->username;
    }
}
