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
use Modules\Home\Http\Controllers\Dashboard\BannerController;
use Modules\Home\Http\Controllers\Dashboard\HomeController;
use Modules\Home\Http\Controllers\Dashboard\OfferController;

Route::middleware('auth:web')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('banner' , BannerController::class);
});

Route::middleware('auth:web')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('offer' , OfferController::class);
});

Route::middleware('auth:web')->name('admin.')->prefix('admin/home-data')->group(function () {
    Route::get('/' , [HomeController::class , 'index'])->name('home.index');
    Route::put('/update' , [HomeController::class , 'update'])->name('home.update');
});