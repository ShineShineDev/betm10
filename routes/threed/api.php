<?php


use App\Http\Controllers\api\threed\ThreedSectionController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ThreedSectionController::class)->group(function () {
        Route::get('/sections/latest', 'getLatestSection');
        Route::post('/sections/bet', 'bet');
        Route::get('/sections/bet/history', 'betHistory');
        Route::get('/sections/history/{year}', 'getHistoryByYear');
    });
});