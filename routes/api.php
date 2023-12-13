<?php

use App\Http\Controllers\admin\payment\PaymentController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\ReferralController;
use App\Http\Controllers\api\SlideController;
use App\Http\Controllers\api\SupportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\SlideTextController;
use App\Http\Controllers\api\twod\TwodBetController;
use App\Http\Controllers\api\twod\TwodSectionController;
use App\Http\Controllers\api\TransactionController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\api\ClosingDayController;


Route::get('/cron-run', function () {
  Artisan::call('schedule:run');
  return "success";
});

Route::get('link', function () {
  Artisan::call('storage:link');
  dd("Hello");
});



Route::post('/login', [UserController::class, 'login'])->name('route');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {

  Route::get('customer', [UserController::class, 'getInfo']);
  Route::post('customer/update-profile', [UserController::class, 'update_profile']);
  Route::post('customer/update-password', [UserController::class, 'update_password']);
  Route::post('customer/changepassword', [UserController::class, 'changePassword']);

  Route::get('twod/sections', [TwodSectionController::class, 'section_list']);
  Route::get('twod/sections/{id}', [TwodSectionController::class, 'detail']);
  Route::get('twod/sections/{id}/numbers', [TwodSectionController::class, 'get_numbers']);
  Route::get('twod/sections/{id}/winners', [TwodSectionController::class, 'getWinners']);
  Route::post('twod/sections/{id}/bet', [TwodBetController::class, 'bet']);
  Route::get('twod/betlogs', [TwodBetController::class, 'bet_list']);
  Route::get('twod/betlogs/{id}', [TwodBetController::class, 'detail']);
  Route::get('twod/calendar/{month_name}/{year}', [TwodSectionController::class, 'calendar']);

  //Deposit  & WithDraw
  Route::get('customer/balanceAmount', [CustomerController::class, 'balance']);
  Route::get('customer/deposit/getlist', [PaymentController::class, 'index']);
  Route::post('customer/deposit', [CustomerController::class, 'store']);
  Route::post('customer/withdraw', [CustomerController::class, 'storeWithdraw']);
  Route::post('transaction/store', [TransactionController::class, 'store']);
  Route::get('transaction/getlist', [TransactionController::class, 'getlist']);

  Route::post('token', [CustomerController::class, 'checkToken']);
  Route::get('referrals/make', [ReferralController::class, 'make']);
  Route::get('closing-days', [ClosingDayController::class, 'list']);

});
Route::get('support/list', [SupportController::class, 'list']);
Route::get('slides/list', [SlideController::class, 'list']);
Route::get('slidetext', [SlideTextController::class, 'index']);




