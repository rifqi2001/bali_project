<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataAccountController;

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
});


