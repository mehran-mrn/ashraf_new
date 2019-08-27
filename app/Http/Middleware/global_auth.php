<?php

namespace App\Http\Middleware;

use Closure;

class global_auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            $url = url()->previous();
            if($url=="http://ashraf.localii/order/cart") {
                session()->put(['url'=>route('store_order')]);
                $messages = trans('messages.for_submit_order_need_to_login');
            }else{
                session()->put(['url'=>route('vow_periodic')]);
                $messages = trans('messages.for_submit_period_payment_first_login_or_register');
            }
            session()->put(['message' => $messages]);
            return redirect(route('global_login_page'));
        }
        return $next($request);

    }
}
