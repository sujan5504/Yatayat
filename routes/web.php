<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', function () {
    return redirect('admin/dashboard');
});

Route::post('api/vehicletype/{vehicle_id}', [VehicleTypeVehicleController::class,'index']);

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [config('backpack.base.middleware_key', 'admin'), 'superadmin'],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('client', 'ClientCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('user', 'UserCrudController');

});