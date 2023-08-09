<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SavingPlanCron extends Controller
{
      /**
     * Get csv file from url and save the data in database after calculation.
     *
     * @return View
     */
    public function __invoke()
    {
        $path               ='/upload/csv/';
        $datetime         = date("Y-m-d H:i:s");
        $currentDate     = date("Y-m-d");
        $strDate         = strtotime($currentDate);
        $nextDate         = strtotime("+1 day", $strDate);
        $nextDate         = date("Y-m-d", $nextDate);
        $year             = date("Y");
        $month             = date("M");
        $today             = date("dmY");
       $url             = "https://mufap.com.pk/pdf/PKRVs/{$year}/{$month}/PKRV{$today}.csv";
     //   $url             = "https://mufap.com.pk/pdf/PKRVs/2022/Aug/PKRV02082022.csv";
        $fileName         = basename($url);
      
        $response = Http::get($url);
        if($response->status() == 200)
        {
            $this->saveFile($path,$fileName,$url);
            $this->insertCsvFileData($path,$fileName);
            $this->calculateMaturity();
        }
        else
        {
            echo 'File not upload on sever yet please run your script after 5:30 pm';
        }

    }
    private function calculateMaturity()
    {
        $result = DB::select(DB::raw("SELECT * FROM `tbl_saving_plan`"));
        for ($i = 0; $i < count($result); $i++) {
            if ($result[$i]->maturity_date > date('Y-m-d')) {
                $id = $result[$i]->id;
                $maturity = calculateDtm(Date("Y-m-d"),Date("Y-m-d",strtotime($result[$i]->maturity_date)));
            }
            else{
                continue;
            }
        
        $maturity-1;
        
        $result2 = DB::select(DB::raw("SELECT * FROM `tbl_pkrv_current` WHERE '$maturity' BETWEEN  `upper` AND `LOWER`"));
        $current=$result2[0]->current/100;
        $previous=$result2[0]->previous/100;
        $upper=$result2[0]->upper;
        $lower=$result2[0]->lower;
        $firstLastDay=$lower-$upper;
        $rate=$current-$previous;
        $currentBand=$maturity-$upper;
        $rateToBeUsed=round(($rate*$currentBand/$firstLastDay)+$previous,6)*100;
        DB::table('tbl_saving_plan')->where('id', '=', $id)
        ->update(['rate' => $rateToBeUsed]);
        }
    }

    private function saveFile($path,$fileName,$url)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        ); 
        file_put_contents(public_path($path.$fileName), file_get_contents($url,'false', stream_context_create($arrContextOptions)));

    }
    private function insertCsvFileData($path,$fileName)
    {
        DB::table('tbl_pkrv_current')->truncate();
        $upperLower = array('upper' => array(0, 8, 16, 31, 61, 91, 121, 181, 271, 366, 731, 1096, 1461, 1826, 2191, 2556, 2921, 3286, 3651, 5476, 7301), 'lower' =>
        array(7, 15, 30, 60, 90, 120, 180, 270, 365, 730, 1095, 1460, 1825, 2190, 2555, 2920, 3285, 3650, 5475, 7300, 10950));

        $dataFile=fopen(public_path($path.$fileName),'r');
        $getData = fgetcsv($dataFile, 100000, ",");
        $row = 0;
        while (($getData = fgetcsv($dataFile, 100000, ",")) !== FALSE) {

        //    echo $num = count($getData);
        //    echo "<br>";
            $current = $getData[1];
            if ($row == 0) {
                $previous = $current;
            }
            $upper        =    $upperLower['upper'][$row];
            $lower        =    $upperLower['lower'][$row];
            if ($row == 20) {
                fclose($dataFile);
                return true;
            }
            DB::table('tbl_pkrv_current')->insert([
                'upper' => $upper,
                'lower' => $lower,
                'previous' => $previous,
                'current' => $current,
                'update_datetime' => date("Y-m-d H:i:s"),
            ]);
            $previous = $current;
            $row++;
           
        }
    
        fclose($dataFile);
        return true;
    }
}
