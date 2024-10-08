<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NumberPlateController;
use App\Http\Controllers\ParkingController;


Route::post('/upload/image', [NumberPlateController::class, 'upload']);

Route::post('/parking/check', [ParkingController::class, 'apiCheckPayment']);
Route::post('/parking/store', [ParkingController::class, 'apiStorePaymentDetails']);