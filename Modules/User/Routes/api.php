<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Api\AddressController;

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

// Route::middleware('auth:sanctum')->controller(AddressController::class)->prefix('addresses')->group(function (){
Route::apiResource('address' , AddressController::class)->except('create' , 'edit');
Route::put('address/{id}/setDefault' , [AddressController::class , 'setDefault'])->middleware('auth:sanctum');
// });