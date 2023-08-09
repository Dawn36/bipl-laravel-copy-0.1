<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavingPlanCron;
use App\Http\Controllers\SavingPlan;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\IjaraSukukController;
use App\Http\Controllers\GeneratePdfController;
use App\Http\Controllers\AuctionBidController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('email-template', function () {
    return view('email/email_trade_initiative');
})->name('email-template');
Route::get('how-to-invest', function () {
    return view('info/how_to_invest');
})->name('how-to-invest');
Route::get('our-saving-plan', function () {
    return view('info/our_saving_plan');
})->name('our-saving-plan');
Route::get('selling-your-investment', function () {
    return view('info/selling_your_investment');
})->name('selling-your-investment');
Route::get('viewing-yor-profile', function () {
    return view('info/viewing_yor_profile');
})->name('viewing-yor-profile');

Route::get('/run-command', function () {
    Artisan::call('sbp:overnight-repo-floor-rate');
    // return 'Command executed successfully!';
});

Route::get('saving_plan_cron', SavingPlanCron::class);
Route::Get('saving_plan', [SavingPlan::class, 'getSavingPlan'])->name('saving_plan');
Route::Get('get_saving_plan_price', [SavingPlan::class, 'getSavingPlanPrice'])->name('get_saving_plan_price');
Route::Get('get_saving_plan_range', [SavingPlan::class, 'getSavingPlanRange'])->name('get_saving_plan_range');
Route::Get('get_saving_plan_price_amount', [SavingPlan::class, 'getSavingPlansAmount'])->name('get_saving_plan_price_amount');

Route::middleware('authSession')->group(function () {
    Route::resource('auction-bid', AuctionBidController::class);
    Route::get('auction-date', [AuctionBidController::class, 'auctionDate'])->name('auction-date');
    Route::get('get-info-auction', [AuctionBidController::class, 'getInfoAuction'])->name('get-info-auction');
    Route::get('get-maturity', [AuctionBidController::class, 'maturity'])->name('get-maturity');

    Route::get('saving_plane_otp', [OtpController::class, 'savingPlanOtpCreate'])->name('saving_plane_otp');
    Route::get('saving_plane_otp_resend', [OtpController::class, 'savingPlanOtpResend'])->name('saving_plane_otp_resend');
    Route::get('info-how-to-use', [SavingPlan::class, 'infoHowToUse'])->name('info-how-to-use');
    Route::get('saving_plane_pin', [SavingPlan::class, 'savingPlanPin'])->name('saving_plane_pin');
    Route::get('saving_plan_ijara', [SavingPlan::class, 'savingPlaneIjara'])->name('saving_plan_ijara');
    Route::get('ijara_show', [IjaraSukukController::class, 'show'])->name('ijara_show');
    Route::get('pdf-non-competitive-bid-form', [GeneratePdfController::class, 'NonCompetitiveBidForm'])->name('pdf-non-competitive-bid-form');
    Route::get('pdf-ijara-sukuk-detail', [GeneratePdfController::class, 'ijaraSukukDetail'])->name('pdf-ijara-sukuk-detail');
    Route::get('saving_plan_index', [SavingPlan::class, 'savingPlanIndex'])->name('saving_plan_index');
    Route::post('saving_plan_index', [SavingPlan::class, 'savingPlanIndexSubmit'])->name('saving_plan_index');
    Route::post('submit_saving_plan', [SavingPlan::class, 'submitSavingPlan'])->name('submit_saving_plan');
    Route::get('saving_plane_create', [SavingPlan::class, 'savingPlanCreate'])->name('saving_plane_create');
    Route::post('otp_auction', [OtpController::class, 'otpAuction'])->name('otp_auction');

});

Route::post('otp_verify', [OtpController::class, 'otpVerify'])->name('otp_verify');


Route::middleware('2fa')->group(function () {
    Route::get('otp', [OtpController::class, 'otpCreate'])->name('otp');
    Route::get('otp_resend', [OtpController::class, 'otpResend'])->name('otp_resend');
});



Route::get('/', function () {
    return redirect()->route('login');
});














// ->middleware(['auth'])
// Route::get('saving_plane_index', function () {
//     return view('saving-plan/saving_plan_index');
// })->name('saving_plane_index');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['2fa'])->name('dashboard');

require __DIR__.'/auth.php';
