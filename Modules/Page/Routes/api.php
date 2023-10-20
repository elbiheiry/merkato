<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Page\Http\Controllers\Api\PageController;

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

Route::controller(PageController::class)->prefix('pages')->group(function (){
    Route::get('/' , 'index')->name('index');
    Route::get('/{slug}' , 'show')->name('show');
});