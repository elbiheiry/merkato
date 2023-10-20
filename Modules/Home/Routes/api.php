<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Home\Http\Controllers\Api\HomeController;

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

Route::middleware('auth:sanctum')->controller(HomeController::class)->prefix('home')->group(function (){
    Route::get('/' , 'index')->name('index');
});