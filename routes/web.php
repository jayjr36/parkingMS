<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NumberPlateController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\AdminController;

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

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
Route::delete('/admin/users/{user}', [AdminController::class ,'deleteUser'])->name('admin.users.delete');

Route::get('/admin/staff/cars', [AdminController::class, 'registerStaffCarForm'])->name('admin.staff.cars.form');
Route::post('/admin/staff/cars', [AdminController::class,'registerStaffCar'])->name('admin.staff.cars.register');

Route::get('/admin/staff/{id}', [AdminController::class, 'viewStaffDetails'])->name('admin.staff.view');

Route::get('/admin/payments', [AdminController::class ,'allPayments'])->name('admin.payments.all');

Route::get('/admin/staff-cars', [AdminController::class, 'showStaffCars'])->name('admin.staffCars');

Route::get('/list/staff', [AdminController::class, 'allStaffDetails'])->name('admin.stafflist');
