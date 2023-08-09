<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TwoFactorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('data')) {
            return redirect()->route('logout');
        }

        if ($request->session()->has('data') && Session::get('user_2fa') == 'yes') {
            return redirect(RouteServiceProvider::HOME);
        }
        // if(Session::get('user_2fa') == 'no')
        // {
            //return redirect()->route('otp');
        // }
        return $next($request);
    }
}
