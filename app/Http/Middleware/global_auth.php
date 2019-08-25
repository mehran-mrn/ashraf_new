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
            $messages = trans('messages.for_submit_period_payment_first_login_or_register');
            session()->put(['message' => $messages]);
            return redirect(route('global_login_page'));
        }
        return $next($request);

    }
}
