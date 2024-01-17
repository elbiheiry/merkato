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
use Modules\Admin\Http\Controllers\Dashboard\AdminController;

Route::middleware('auth:web')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('admin', AdminController::class)->except(['show' , 'create']);
});
