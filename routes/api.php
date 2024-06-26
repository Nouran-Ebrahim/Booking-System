<?php

use App\Http\Controllers\Api\AuthanticationController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('login', [AuthanticationController::class, 'login']);
    Route::post('logout', [AuthanticationController::class, 'logout']);
    Route::post('register', [AuthanticationController::class, 'register']);
    Route::get('rooms', [RoomController::class, 'index']);
    Route::post('book', [BookingController::class, 'store']);


});


