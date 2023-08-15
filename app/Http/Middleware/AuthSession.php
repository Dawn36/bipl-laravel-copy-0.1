<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;

class AuthSession
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
        // dd($request->session()->has('data'));
        if (!$request->session()->has('data')) {
            return redirect()->route('logout');
        }
        if($request->session()->has('data') && Session::get('user_2fa') == 'no')
        {
            return redirect()->route('otp');
        }    
        if($request->session()->has('data') && Session::get('user_2fa') == 'yes')
        {
            return $next($request);
        }
    }
}
