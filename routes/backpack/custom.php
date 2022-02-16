<?php

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
    Route::crud('client', 'ClientCrudController');
    Route::crud('vehicle', 'VehicleCrudController');
    Route::crud('vehicletype', 'VehicleTypeCrudController');
    Route::crud('bookingpolicy', 'BookingPolicyCrudController');
    Route::crud('vehicledetail', 'VehicleDetailsCrudController');
}); // this should be the absolute last line of this file