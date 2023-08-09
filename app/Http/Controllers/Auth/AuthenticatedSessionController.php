<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // $employees = DB::connection('oracle')->table('cat')->get();
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse LoginRequest
     */
    public function store(Request $request)
    {
        $email=$request->email;
        $password=$request->password;

        $endPoint=env('SET_END_POINT');
        $response = Http::post($endPoint.'/Login', [
            'userName' => $email,
            'password' => $password,
        ]);
        $sessionData=$response->json();
        $sessionData['data']['userName'] = $email;
        if($sessionData['status'] == '200')
        {
            $request->session()->put($sessionData);
            Session::put('user_2fa', 'no');
            return redirect("otp");
        }
        else 
        {
            $request->session()->flash('error', $sessionData['messages'][0]);
            return redirect()->back();
        }
      //  $request->authenticate();

        //$request->session()->regenerate();
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->session()->flush();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
