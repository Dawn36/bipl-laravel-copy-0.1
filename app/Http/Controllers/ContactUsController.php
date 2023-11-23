<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactUsController extends Controller
{
    public  $sessionId;
    public  $userName;
    public  $account;
    public  $endPoint ;

    public function __construct()
    {
        $data=Session::get('data');
        if(!empty($data))
        {
            $this->endPoint  =env('SET_END_POINT');
            $this->sessionId =$data['SESSION_ID'];
            $this->account =$data['Account'];
            $this->userName =$data['userName'];
        }
        else
        {
            return  redirect()->route('logout');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Session::get('data');
        return view('contact-us/contact_us_create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataArr=array();
        $subject = 'Contact Us'.$request->account_number;
        $fileName = 'email/email_contact_us';
        $toEmail = 'ips@akdsl.com';
        $dataArr['name']=$request->name;
        $dataArr['account']=$request->account_number;
        $dataArr['email']=$request->email;
        $dataArr['description']=$request->description;
        sendEmail($toEmail, $subject, $fileName, $dataArr);
        $request->session()->flash('success', "Your message has been received. We will contact you shortly.");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
