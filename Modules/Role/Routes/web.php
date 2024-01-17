<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\Dashboard\RoleController;

/**
* Role Routes
*/
Route::middleware('auth:web')->name('admin.')->prefix('admin')->group(function () {
    Route::resource('role' ,RoleController::class);
});