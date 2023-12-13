<?php


use App\Http\Controllers\admin\threed\ThreeDBetSlipController;
use App\Http\Controllers\admin\threed\ThreedBettingLogsController;
use App\Http\Controllers\admin\threed\ThreedDefaultSettingController;
use App\Http\Controllers\admin\threed\ThreedSectionController;
use Illuminate\Support\Facades\Route;

$in_route = [
    'middleware' => 'auth',
    'prefix' => 'admin/threed',
    'as' => 'admin.threed.',
];

Route::group($in_route, function () {

    //Default Settings
    Route::resource('default_settings', ThreedDefaultSettingController::class, ['except' => ['show', 'destroy']]);

    // Section
    Route::resource('section', ThreedSectionController::class);
    Route::controller(ThreedSectionController::class)->group(function () {
        Route::post('section/winning_number/before_confirm', 'winningNumberBeforeConfirm')->name('section.winning_number.before_confirm');

        // block_number
        Route::delete('section/block_number/{id}', 'deleteBlockNumber')->name('section.block_number.delete');
        Route::post('section/block_number/store', 'storeBlockNumber')->name('section.block_number.store');

        // NumberLimit
        Route::post('section/number_limit/store', 'storeNumberLimit')->name('section.number_limit.store');
        Route::delete('section/number_limit/delete/{id}', 'deleteNumberLimit')->name('section.number_limit.delete');

    });

    // Bet Slip 
    Route::controller(ThreeDBetSlipController::class)->group(function () {
        Route::get('bet_slip', 'index')->name('bet_slip.index');
        Route::get('bet_slip/show/{id}', 'show')->name('bet_slip.show');
        Route::put('bet_slip/reject/{id}', 'reject')->name('bet_slip.reject');
    });

    //Bet log
    Route::get('betting_logs', [ThreedBettingLogsController::class, 'index'])->name('bet_logs.index');

});