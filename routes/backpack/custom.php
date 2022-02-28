<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.
Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('gender', 'GenderCrudController');
    Route::crud('employeetype', 'EmployeeTypeCrudController');
    Route::crud('employee', 'EmployeeCrudController');
    Route::crud('vehicle', 'VehicleCrudController');
    Route::crud('vehicletype', 'VehicleTypeCrudController');
    Route::crud('bookingpolicy', 'BookingPolicyCrudController');
    Route::crud('vehicledetail', 'VehicleDetailsCrudController');
    Route::crud('destination', 'DestinationCrudController');
    Route::crud('vehicleassign', 'VehiclesAssignCrudController');
    Route::crud('checkvehiclehire', 'CheckVehicleHireCrudController');
}); // this should be the absolute last line of this file

Route::group([
    'middleware' => ['web'],
    'namespace'  => 'App\Http\Controllers',
], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::post('logout', [LoginController::class,'logout']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
    Route::post('register', [RegisterController::class, 'register']);
});