<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Type\Http\Controllers\Api\TypeController;

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

Route::middleware('auth:sanctum')->controller(TypeController::class)->prefix('types')->group(function (){
    Route::get('/' , 'index')->name('index');
    Route::get('/show/{slug}' , 'show')->name('show');
});