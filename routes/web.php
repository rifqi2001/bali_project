<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataAccountController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContentController;

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

Route::get('/', function () {
    return view('landingPage');
});
Route::get('/coba', function () {
    return view('contents.coba');
});


Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'login')->name('login');
    Route::post('/login-process', 'actionlogin')->name('actionlogin');
    Route::get('/logout', 'actionlogout')->name('logout');

});

Route::middleware(['auth', 'role:superAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboardAdmin');
    })->name('dashboard');
    Route::resource('data-akun', DataAccountController::class);
    Route::resource('tickets', TicketController::class);
    Route::get('/tickets/{id}/detail', [TicketController::class, 'detail'])->name('tickets.detail');
    Route::resource('payments', PaymentController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('contents', ContentController::class);
    
});

// Route::get('/transaksi', [TicketController::class, 'index'])->name('tickets.index');
Route::get('password/reset/{token}', function ($token) {
    // Di sini Anda dapat menampilkan halaman reset password atau mengarahkan ke halaman front-end.
    return view('auth.passwords.reset', ['token' => $token]);
})->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
