<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NumberPlateController;
use App\Http\Controllers\ParkingController;

Route::get('/plates', [NumberPlateController::class, 'showPlates'])->name('plates.index');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/parking/payment', [ParkingController::class, 'showPaymentForm'])->name('parking.payment.form');
Route::post('/parking/payment', [ParkingController::class, 'processPayment'])->name('parking.payment.process');


Route::get('/parking/search', [ParkingController::class, 'showSearchForm'])->name('parking.search');
Route::post('/parking/search', [ParkingController::class, 'searchPlateNumber']);