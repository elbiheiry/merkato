<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Api\CartController;
use Modules\Product\Http\Controllers\Api\ProductController;

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

Route::middleware('auth:sanctum')->controller(ProductController::class)->prefix('products')->group(function (){
    Route::get('/' , 'index')->name('index');
});

Route::middleware('auth:sanctum')->controller(CartController::class)->prefix('cart')->group(function (){
    Route::get('/all', 'index')->name('index');
    Route::post('/add-item' , 'addItem')->name('create');
    // Route::post('/apply-coupon' , 'applyCoupon')->name('applyCoupon');
    Route::delete('/delete-cart-item/{id}' , 'deleteCartItem')->name('deleteCartItem');
    // Route::delete('/delete-coupon' , 'removeCoupon')->name('removeCoupon');
});