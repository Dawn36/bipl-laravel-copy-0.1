<?php 
use Illuminate\Support\Facades\Mail;

function calculateDtm($created_date, $closed_date){

    $start_ts = strtotime($created_date);
    $end_ts = strtotime($closed_date);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}
function sendEmail($toEmail,$subject,$fileName,$data='')
{
    $to_email=$toEmail;
    // $to_email='dawngill08@gmail.com';
    $from_email = env('MAIL_FROM_ADDRESS');
    $subject = $subject;
    // $cc = env('CCEMAIL');
    $sendEmail=env('SEND_EMAIL');
    if($sendEmail == '1')
        {
            Mail::send("$fileName", ['data' => $data], function ($message) use ($to_email, $from_email, $subject) {
                $message->to($to_email)
                    ->subject($subject);
                $message->from($from_email);
          });    

        }
}
?>