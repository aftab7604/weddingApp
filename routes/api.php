<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/vendors', [VendorController::class, 'index']);
Route::middleware('auth:sanctum')->post('/orders', [OrderController::class, 'placeOrder']);
Route::middleware('auth:sanctum')->get('/orders', [OrderController::class, 'getOrders']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
