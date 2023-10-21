<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\Api\CouponController;

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

Route::middleware('auth:sanctum')->controller(CouponController::class)->prefix('coupons')->group(function (){
    Route::post('/apply-coupon' , 'applyCoupon')->name('applyCoupon');
    Route::delete('/delete-coupon' , 'removeCoupon')->name('removeCoupon');
});