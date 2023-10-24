<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('customer')->group(function () {

    Route::group(['middleware' => 'frontend'], function () {
        Route::get('/', [\App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'index'])->name('frontend.dashboard.index');


        //Auth
        Route::prefix('auth')->group(function () {
            Route::get('/logout', [\App\Http\Controllers\Auth\FrontendLoginController::class, 'logout'])->name('frontend.auth.logout');
        });

        //User

        Route::prefix('user')->group(function () {
            Route::get('/', [\App\Http\Controllers\Frontend\User\UserController::class, 'index'])->name('frontend.user.index');
        });
    });
});
