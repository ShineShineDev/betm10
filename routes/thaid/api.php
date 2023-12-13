<?php


use App\Http\Controllers\api\thaid\ThaidSectionController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ThaidSectionController::class)->group(function () {
        Route::get('/sections/latest', 'getLatestSection');
        Route::post('/sections/bet', 'bet');
        Route::get('/sections/bet/history', 'betHistory');
        // Route::get('/sections/history/{year}', 'getHistoryByYear');
    });
});