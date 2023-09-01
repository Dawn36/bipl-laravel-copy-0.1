<?php

namespace App\Http\Controllers;

use App\Models\AuctionBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use PDO;

class AuctionBidController extends Controller
{
    public  $sessionId;
    public  $userName;
    public  $account;
    public  $endPoint;

    public function __construct()
    {
        $data = Session::get('data');
        if (!empty($data)) {
            $this->endPoint  = env('SET_END_POINT');
            $this->sessionId = $data['SESSION_ID'];
            $this->account = $data['Account'];
            $this->userName = $data['userName'];
        } else {
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
        $clientInfo = DB::connection('oracle')->table('IPS_CLIENT_INFO')->where('CLIENT_CODE', $this->account)->first();
        $account = $this->account;
        return view('auction-bid/auction_bid_create', compact('clientInfo', 'account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for($i=0; $i < count($request->maturity); $i++)
        {
            $data = DB::connection('oracle')->table('IPS_SCHEME')->where('AUCTION_ID', $request->maturity[$i])->first();
            $auctionId = settype($data->auction_id, "int");
            $auctionDate = DATE("Y-m-d", strtotime($data->auction_date));
            $schemeCode = $data->scheme_code;
            $issueDate = DATE("Y-m-d", strtotime($data->issue_date));
            $maturityDate = DATE("Y-m-d", strtotime($data->maturity_date));
            $clientCode = $this->account;
            $amount = $request->amount[$i];
            $amount = settype($amount, "int");
            $inputParam1 = $auctionId;
            $inputParam2 = $auctionDate;
            $inputParam3 = $schemeCode;
            $inputParam4 = $issueDate;
            $inputParam5 = $maturityDate;
            $inputParam6 = $clientCode;
            $inputParam7 = $amount;
            $inputParam8 = null;
            $outputParam = ''; // Initialize the output parameter
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("begin INSERT_AUCTION_EOI(:p1, :p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9); end;");
            $stmt->bindParam(':p1', $inputParam1, PDO::PARAM_INT);
            $stmt->bindParam(':p2', $inputParam2, PDO::PARAM_STR);
            $stmt->bindParam(':p3', $inputParam3, PDO::PARAM_STR);
            $stmt->bindParam(':p4', $inputParam4, PDO::PARAM_STR);
            $stmt->bindParam(':p5', $inputParam5, PDO::PARAM_STR);
            $stmt->bindParam(':p6', $inputParam6, PDO::PARAM_STR);
            $stmt->bindParam(':p7', $inputParam7, PDO::PARAM_INT);
            $stmt->bindParam(':p8', $inputParam8, PDO::PARAM_STR);
            $stmt->bindParam(':p9', $outputParam, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
            $stmt->execute();
            // Get the value of the output parameter
            $outputValue = $stmt->bindParam(':p9', $outputParam, PDO::PARAM_STR | PDO::PARAM_INPUT_OUTPUT, 4000);
        }
        if($outputValue == true)
        {
            return true;
        }
        return false;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuctionBid  $auctionBid
     * @return \Illuminate\Http\Response
     */
    public function show(AuctionBid $auctionBid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuctionBid  $auctionBid
     * @return \Illuminate\Http\Response
     */
    public function edit(AuctionBid $auctionBid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuctionBid  $auctionBid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuctionBid $auctionBid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuctionBid  $auctionBid
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuctionBid $auctionBid)
    {
        //
    }
    public function auctionDate(Request $request)
    {
        $date = DATE("Y-m-d");
        return  DB::connection('oracle')->table('IPS_SCHEME')->selectRaw('DISTINCT auction_date')->where('SCHEME_TYPE', $request->nonCompetitiveids)->whereDate('LAST_BID_DATE', '>=', $date)->get();
    }
    public function maturity(Request $request)
    {
        $date = DATE("Y-m-d", strtotime($request->auction_date));
        return  DB::connection('oracle')->table('IPS_SCHEME')
            ->where('SCHEME_TYPE', $request->nonCompetitiveids)->whereDate('AUCTION_DATE', $date)->get();
    }
    public  function getInfoAuction(Request $request)
    {
        $data= array();
        // $data['client_info']= DB::connection('oracle')->table('IPS_CLIENT_INFO')
        //     ->where('CLIENT_CODE', $this->account)->first();
        
        // $response = Http::withHeaders([
        //     'SESSION_ID' => $this->sessionId,
        // ])->post($this->endPoint.'getAccountBalance', [
        //     'userName' => $this->userName,
        //     'ClientCode' => $this->account,
        // ]);
        // $cashBalance=0;
        // $data=$response->json();
        // if($data['status'] == '200' || $data['status'] == '201')
        // {
        //     $cashBalance=$data['data'][0]['Cash_Balance'];
        // }
        $cashBalance=DB::connection('oracle')->table('IPS_CLIENT_BALANCE')->where('CLIENT_CODE', $this->account)->select('LEDGER_BALANCE')->first();
        $cashBalance=trim($cashBalance->ledger_balance, '-');
        $data['cash_balance']=$cashBalance;
        $data['auction_details']= DB::connection('oracle')->table('IPS_SCHEME')
            ->where('AUCTION_ID', $request->auction_id)->first();
            return $data;
    }
}
