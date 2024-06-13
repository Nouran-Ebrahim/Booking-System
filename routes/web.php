<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('roles', RolesController::class);
        Route::resource('admins', AdminController::class);
        Route::post('roomsChangeStatus',[RoomController::class, 'roomsChangeStatus'])->name('roomsChangeStatus');
        Route::resource('rooms', RoomController::class);

        Route::resource('clients', ClientController::class);
        Route::resource('bookings', BookingController::class);


    });

});
