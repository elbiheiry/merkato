<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\AuthController;

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

Route::middleware([])
    ->name('auth.')
    ->prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/verify', 'verify')->name('verify');
        Route::post('/register', 'register')->name('register');
        Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
        
        Route::post('/forget-password' , 'forget_password')->name('forget_password');
        Route::post('/change-password' , 'change_password')->name('change_password');

        Route::delete('/delete-account' , 'delete_account')->name('delete');
    });
