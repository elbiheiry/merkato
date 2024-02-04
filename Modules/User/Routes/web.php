<?php

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

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Dashboard\UserController;

Route::middleware('auth:web')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('user' , UserController::class);
    Route::get('change-status/{user}' , [UserController::class , 'changeStatus'])->name('user.status');
});
