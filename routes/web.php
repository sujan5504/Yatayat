<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\VehicleHireController;
use App\Http\Controllers\Api\VehicleTypeVehicleDetail;
use App\Http\Controllers\Api\DependentDropdownController;
use App\Http\Controllers\Api\VehicleTypeVehicleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return redirect('admin/dashboard');
});

Route::post('api/vehicletype/{vehicle_id}', [VehicleTypeVehicleController::class,'index']);
Route::post('api/vehicledetail/{vehicle_id}', [VehicleTypeVehicleDetail::class,'index']);
Route::get('/getvehicle/{id}', [DependentDropdownController::class, 'getvehicle']);

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [config('backpack.base.middleware_key', 'admin'), 'superadmin'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('client', 'ClientCrudController');
    Route::crud('role', 'RoleCrudController');
});

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
});

Route::get('/', [HomeController::class, 'index']);
Route::post('/getvehicleseatdetails', [HomeController::class, 'getVehicleSeatDetails']);
Route::post('/bookseat', [BookingController::class, 'getSelectedSeatDetails']);
Route::post('/savebooking', [BookingController::class, 'store']);

Route::resource('userprofile', UserProfileController::class);
Route::resource('vehiclehire', VehicleHireController::class);
Route::get('aboutus',function(){
    return view('aboutus');
});