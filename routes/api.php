<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TicketController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/ticket/create', [TicketController::class, 'create']);
    Route::get('/ticket', [TicketController::class, 'index']);
    Route::get('/ticket/{id}', [TicketController::class, 'show']);
    // Route::post('/payment/confirm', [PaymentController::class, 'store']);
});

// Route::middleware('auth:sanctum')->post('/ticket/create', [TicketController::class, 'create']);
// Route::get('/ticket/{id}', [TicketController::class, 'getTicket']);
Route::delete('/ticket/{id}', [TicketController::class, 'destroy']);
Route::put('/ticket/{id}', [TicketController::class, 'update']);
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/payment/confirm', [PaymentController::class, 'confirmPayment']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');