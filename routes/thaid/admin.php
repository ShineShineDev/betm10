<?php



use App\Http\Controllers\admin\thaid\ThaidSectionController;
use Illuminate\Support\Facades\Route;

$in_route = [
    'middleware' => 'auth',
    'prefix' => 'admin/thaid',
    'as' => 'admin.thaid.',
];

Route::group($in_route, function () {
    Route::resource('section', ThaidSectionController::class);
});