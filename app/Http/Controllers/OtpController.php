<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Otp;
use nusoap_client;
use App\Models\SmsLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class OtpController extends Controller
{
    public function otpCreate()
    {
        $data=Session::get('data');
        $email=$data['Email'];
        if(Session::get('resendotp') == '1')
        {
            $this->sendOtp();
            return redirect()->route('otp');
        }
        if(!Session::get('resendotp'))
        {
            $this->sendOtp();
        }
        
            return view('login/otp',compact('email'));
        
        // return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
        
    }
   
    public function savingPlanOtpCreate(Request $request)
    {
        $redirectRoute=$request->redirect_route;
        $data=Session::get('data');
        $email=$data['Email'];
        $this->sendOtp();
        return view('saving-plan/saving_plan_otp',compact('email','redirectRoute'));
        // return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    public function savingPlanOtpResend()
    {
        // Session::put('resendotp', '1');
        return $this->sendOtp();
    }
    public function sendOtp()
    {
        $data=Session::get('data');
        $userId=$data['SESSION_ID'];
        $email=$data['Email'];
        $phoneNumber=$data['Mobile_No'];
        $otpCode=rand(123456, 999999);
        $sms="Your otp code is $otpCode and expire in 2 min";
        $smsUserId=env('SMS_USER_ID');
        $smsPassword=env('SMS_PASSWORD');
        Session::put('resendotp', '2');
        Otp::create([
         'user_id' => $userId,
         'otp_code' => $otpCode, 
         //'otp_code' => '000000',
         'expires_at' => Carbon::now()->addMinutes(2)
         ]);
         SmsLog::create([
            'user_id' => $userId,
            'otp_code' => $otpCode, 
            'mobile_no' => $phoneNumber,
            'expires_at' => Carbon::now()->addMinutes(2)
            ]);
         $url = 'https://secure.m3techservice.com/GenericService/webservice_4_1.asmx?WSDL';
         //sir 3008217084
         $client = new nusoap_client($url, 'wsdl');
         $params = array(
             'UserId' =>  $smsUserId,
             'Password' => $smsPassword,
             'MobileNo' => $phoneNumber,
             'MsgId' => '1',
             'SMS' => $sms ,
             'MsgHeader'=> '5272'
         );
         $result = $client->call('SendSMS',$params);
    }
    public function otpResend()
    {
        Session::put('resendotp', '1');
        return $this->otpCreate();
    }
    public function otpVerify(Request $request)
    {
        $data=Session::get('data');
        $userId=$data['SESSION_ID'];
        $opt=$request->otp;
         $otp=implode("",$opt);
        //  $userId=Auth::user()->id;
        $verificationCode = Otp::where('user_id', $userId)->where('otp_code', $otp)->latest()->first();
       
        $now = Carbon::now();
        if($verificationCode && $now->isBefore($verificationCode->expires_at)){
            Session::put('user_2fa', 'yes');
            $verificationCode = Otp::where('user_id', $userId)->delete();
            return 200;
            // return redirect()->intended(RouteServiceProvider::HOME);
        }
        else
        {
            // $verificationCode = Otp::where('user_id', $userId)->delete();
             return 400 ;
        }

    }
    public function otpAuction()
    {
        $this->sendOtp();
    }
   
}
