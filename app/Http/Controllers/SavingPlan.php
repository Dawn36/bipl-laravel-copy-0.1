<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class SavingPlan extends Controller
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
    public function getSavingPlan()
    {
        $rate=DB::connection('mysql')->table('sbp_rate')->select('rate')->latest()->first();
        $endPoint=env('SET_END_POINT');
        $data=Session::get('data');
        $sessionId=$data['SESSION_ID'];
        $response = Http::withHeaders([
            'SESSION_ID' => $this->sessionId,
        ])->post($this->endPoint.'GetCash', [
            'userName' => $this->userName,
        ]);
        $data=$response->json();
        if($data['status'] == '200' || $data['status'] == '201')
        {
        // dd($response->json()); || $data['status'] == '201'
        $result=$data['data'];
        $sb = "<option value=''>Select Saving Plan</option>";
        foreach ($result as $row) {
            $maturity_date = date('Y-m-d',strtotime($row['Maturity_Date']));
            $diff = CalculateDTM(date('Y-m-d'), $maturity_date) ;
            $sbpRepoFloorRate=$rate->rate; //%
            $savingRate=$sbpRepoFloorRate-0.5;
            $wht=$savingRate*0.15;
            $netSavingRate=$savingRate-$wht;
            $price=100/(1+($row['Offer_Price']/36500*$diff));
            $pdPrice=$row['PD_Value'];
            $faceVal=100;
            $profitAtMaturity=$faceVal-$pdPrice;
            $taxOnProfit=$profitAtMaturity*0.15;
            $netProfit=$faceVal-$price-$taxOnProfit;
            $perDayProfit=$netProfit/$diff;
            $annualProfit=$perDayProfit*365;
            $amountInvested=$price;
            $percentageReturn=($annualProfit/$amountInvested)*100;
            //dd();
            if($percentageReturn < $netSavingRate)
            {
                continue;
            }
            // dd($price);
            // $issue_date = $row->issue_date;
            // $maturity_date = $row->maturity_date;
           
            // yield change to offer price
            $yield = $row['Yield'];
            $offerPrice = $row['Offer_Price'];
            $pdValue = $row['PD_Value'];
            $schemeCode = $row['Scheme_Code'];
            $issueDate = Date('Y-m-d',strtotime($row['Issue_Date']));
            //date('Y-m-d')
            $diff = CalculateDTM(date('Y-m-d'), $maturity_date) ;

            $concat = "$diff|$yield|$pdValue|$schemeCode|$issueDate";
            if ($diff > 0) {
                $sb .= "<option value=".$concat." data-rate=".$yield.">".$diff." days (Yield ".sprintf("%.2f", $offerPrice)." % p.a)</option>";
            }

        }

        echo trim($sb);
        }
        else
        {
          return  redirect()->route('logout');
        }
        // $result=DB::table('tbl_saving_plan')->get();
        // $sb = "<option value=''>Select Saving Plan</option>";
        
        // foreach ($result as $row) {
        //     $issue_date = $row->issue_date;
        //     $maturity_date = $row->maturity_date;
        //     $rate = $row->rate;
        //     //date('Y-m-d')
        //     $diff = CalculateDTM(date('Y-m-d'), $maturity_date) - 1;

        //     $concat = "$diff|$rate";
        //     if ($diff > 0) {
        //         $sb .= "<option value=".$concat." data-rate=".$rate.">".$diff." days (Yield ".$rate." % p.a)</option>";
        //     }

        // }

    }
    public function getSavingPlanPrice(Request $request)
    {
        $rate   = isset($request->rate) ? ($request->rate/100) : '';
        $DTM    = isset($request->DTM) ? $request->DTM : '';
        
        $price = round(100/(1+($DTM/365*$rate)),4);

        echo trim($price);
    }
    public function getSavingPlansAmount(Request $request){
        // dd($request);
        $FV    = isset($request->FV) ? $request->FV : '';
        $price = isset($request->price) ? $request->price : '';
        $must_invest = ($price/100*$FV);
        // $must_invest = (int)($must_invest);
        $profit = ($FV-$must_invest);
        $must_invest = number_format($must_invest,4);
        $profit = number_format($profit,4);
        $FV = number_format($FV,4);
        echo trim("$must_invest|$profit|$FV");
    }
    public function getSavingPlanRange(Request $request)
    {
         $dmt=$request->dmt - 1;
        $investedAmount=$request->investedAmount;
        $rate=$request->rate;
        $price=round(100/(1-$rate*($dmt)/365),4);
        echo number_format($investedAmount*$price/100,4); 

    }
    public function savingPlanIndex()
    {
        
        $response = Http::withHeaders([
            'SESSION_ID' => $this->sessionId,
        ])->post($this->endPoint.'GetPortfolio', [
            'userName' => $this->userName,
        ]);
        $data=$response->json();
        if($data['status'] == '200' || $data['status'] == '201')
        {
            $data=$data['data'];
            return view('saving-plan/saving_plan_index',compact('data'));
        }
        else
        {
          return  redirect()->route('logout');
        }
    }
    public function savingPlanPin(Request $request)
    {
        $redirectRoute=$request->redirect_route;
        $day=$request->days;
        $data=Session::get('data');
        $email=$data['Email'];
        return view('saving-plan/saving_plan_pin',compact('email','redirectRoute','day'));
        // return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    public function savingPlanCreate()
    {
        $endPoint=env('SET_END_POINT');
        $data=Session::get('data');
        $sessionId=$data['SESSION_ID'];
        // $response = Http::withHeaders([
        //     'SESSION_ID' => $this->sessionId,
        // ])->post($this->endPoint.'getAccountBalance', [
        //     'userName' => $this->userName,
        //     'ClientCode' => $this->account,
        // ]);
        $cashBalance=0;
        // $data=$response->json();
        // if($data['status'] == '200' || $data['status'] == '201')
        // {
        //     $clashBalance=$data['data'][0]['Cash_Balance'];
        // }
        $cashBalance=DB::connection('oracle')->table('IPS_CLIENT_BALANCE')->where('CLIENT_CODE', $this->account)->select('LEDGER_BALANCE')->first();
        try {
            $cashBalance=trim($cashBalance->ledger_balance, '-');
        } catch (\Throwable $th) {
            $cashBalance=0;
        }
        // $cashBalance=trim($cashBalance->ledger_balance, '-');
        $sessionId=$this->sessionId;
        return view('saving-plan/saving_plan_create',compact('sessionId','cashBalance'));
    }
    public  function submitSavingPlan(Request $request)
    {
		// $request->session()->flash('error', 'Invalid! Email Or Password');
        $tableJson=json_decode($request->table_json);
        $pin=$request->pin;
        $faceValue=$request->invest_amount;
        // $data=Session::get('data');
        // $sessionId=$data['SESSION_ID'];
        for ($i=0; $i < count($tableJson) ; $i++) { 
            $yeild=explode('|',$tableJson[$i]->saving_plan);
            $issueDate=$yeild[4];
            // $maturity=$tableJson[$i]->maturity;
            $investAmount=str_replace("Rs.","",$tableJson[$i]->invest_amount);
            $investAmount=str_replace("/-","",$investAmount);
            $investAmount=str_replace(",","",$investAmount);
            $price=100/((($yeild[1]-1)*($yeild[0]/36500))+1);
            $price=round($price,4);
            $yeildString=$yeild[1]-1;
            settype($price, "string");
            settype($yeildString, "string");
            // $data=[
            //     'userName' => $this->userName,
            //     'Trade_Date' => Date('Y-m-d'),
            //     'Scheme_Code' => $yeild[3],
            //     'Client_Code' => $this->account,
            //     'Yeild' => $yeildString,
            //     'Investment_Amount' => $investAmount,
            //     'Brokerage' => '000',
            //     'PIN' => $pin,
            //     'Price' => $price,
            //     'Buy_bef_mut' =>"Y",
            //     "Face_val"=> $faceValue,
            //     "issue_date"=> $issueDate,
            //     "maturity_date"=> Date('Y-m-d',strtotime("+".$yeild[0]."Days"))
            // ];
            // dd($data);
            $response = Http::withHeaders([
                'SESSION_ID' => $this->sessionId,
            ])->post($this->endPoint.'GetBuyOrder', [
                'userName' => $this->userName,
                'Trade_Date' => Date('Y-m-d'),
                'Scheme_Code' => $yeild[3],
                'Client_Code' => $this->account,
                'Yeild' => $yeildString,
                'Investment_Amount' => $investAmount,
                'Brokerage' => '000',
                'PIN' => $pin,
                'Price' => $price,
                'Buy_bef_mut' =>"Y",
                "Face_val"=> $faceValue,
                "issue_date"=> $issueDate,
                "maturity_date"=> Date('Y-m-d',strtotime("+".$yeild[0]."Days"))
            ]);
        $responseEmail=$response->json();
            if($responseEmail['status'] == '200')
            {
                if($responseEmail['data'][0]['Message'] == "Order has been sent to trade server")
                {
                    $dataArr=array();
                    $dataArr['buy_or_sell']='Buy';
                    $dataArr['client_code']=$this->account;
                    $dataArr['scheme_code']=$yeild[3];
                    $dataArr['maturity_date']=$tableJson[$i]->maturity_date;
                    $dataArr['face_value']=$faceValue;
                    $dataArr['invest_amount']=$investAmount;
                    $dataArr['price']=$price;
                    $dataArr['yield']=$yeildString;
                    $subject='Trade Initiated - Buy - ('.$this->account.')';
                    $fileName='email/email_trade_initiative';
                    $toEmail='ips@akdsl.com';
                    sendEmail($toEmail,$subject,$fileName,$dataArr);
                }
            }
        }
        $response=$response->json();
        if($response['status'] == '200')
        {
            if($response['data'][0]['Message'] == "Order has been sent to trade server")
            {
                $request->session()->flash('success', $response['data'][0]['Message']);
            }
            else
            {
                $request->session()->flash('error', $response['data'][0]['Message']);
            }
        }
        elseif($response['status'] == '201')
        {
            $request->session()->flash('error', $response['messages'][0]);
        }
        else
        {
            // $request->session()->flash('error', $response['data'][0]);
           return  redirect()->route('logout');
        }

        return redirect()->back();
    }
    public  function savingPlanIndexSubmit(Request $request)
    {
		// $request->session()->flash('error', 'Invalid! Email Or Password');
        $akdBidPrice=$request->akd_bid_price;
        // $akdBidPrice=str_replace('%', '', $request->akdBidPrice);
        settype($akdBidPrice, "float");
        $unit=$request->unit;
        $sellingAmount=str_replace(',', '', $request->selling_amount);
        $sellingAmount= round($sellingAmount);
        $schemeCode=$request->scheme_code;
        $pin=$request->pin;
        $price=100/((($request->dtm)*($akdBidPrice/36500))+1);
        $price=round($price,4);
        $unit=$unit*5000;
        settype($price, "string");
        settype($unit, "string");
        settype($sellingAmount, "string");
        settype($akdBidPrice, "string");
        $response = Http::withHeaders([
            'SESSION_ID' => $this->sessionId,
        ])->post($this->endPoint.'GetSellOrder', [
            'userName' => $this->userName,
            'Trade_Date' => Date('Y-m-d'),
            'Scheme_Code' => $schemeCode,
            'Client_Code' => $this->account,
            'Sell_Amount' => $sellingAmount, // tran amount
            'Brokerage' => '000',
            'OriginSellAmount' => $unit, //this is unit
            'PIN'=>$pin,
            "Price"=> $price,
            "Sell_bef_mut"=> "Y",
            "Face_val"=> $unit,
            "Yeild_val"=> $akdBidPrice,
            "issue_date"=> Date('Y-m-d',strtotime($request->issue_date)),
            "maturity_date"=> Date('Y-m-d',strtotime("+".$request->dtm."Days"))
        ]);
        $response=$response->json();
        
        if($response['status'] == '200')
        {
            if($response['data'][0]['Message'] == "Order has been sent to trade server")
            {
                $dataArr=array();
                    $dataArr['buy_or_sell']='Sell';
                    $dataArr['client_code']=$this->account;
                    $dataArr['scheme_code']=$schemeCode;
                    $dataArr['maturity_date']=Date('Y-m-d',strtotime('+'.$request->dtm.' days'));
                    $dataArr['face_value']=$unit;
                    $dataArr['invest_amount']=$sellingAmount;
                    $dataArr['price']=$price;
                    $dataArr['yield']=$akdBidPrice;
                    $subject='Trade Initiated - Sell - ('.$this->account.')';
                    $fileName='email/email_trade_initiative';
                    $toEmail='ips@akdsl.com';
                    sendEmail($toEmail,$subject,$fileName,$dataArr);
                $request->session()->flash('success', $response['data'][0]['Message']);
            }
            else
            {
                $request->session()->flash('error', $response['data'][0]['Message']);
            }
        }
        elseif($response['status'] == '201')
        {
            $request->session()->flash('error', $response['messages'][0]);
        }
        else
        {
            return  redirect()->route('logout');
        }

        return redirect()->back();
    }
    public function infoHowToUse()
    {
        return view('info/info_how_to_use');
    }
    public function savingPlaneIjara()
    {
        return view('saving-plan/saving_plan_ijara');
    }
}
