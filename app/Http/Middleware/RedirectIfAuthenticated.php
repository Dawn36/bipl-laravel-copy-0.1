<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;

use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RedirectIfAuthenticated
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if($request->session()->has('data') && Session::get('user_2fa') == 'no')
        {
            return  redirect()->route('otp');
        }
        if($request->session()->has('data') && Session::get('user_2fa') == 'yes')
        {   
            return redirect(RouteServiceProvider::HOME);

        }
        $guards = empty($guards) ? [null] : $guards;
        
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                
                return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}
