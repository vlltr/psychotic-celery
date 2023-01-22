<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('auth/register', \App\Http\Controllers\Api\V1\Auth\RegisterController::class);
    Route::post('auth/login', \App\Http\Controllers\Api\V1\Auth\LoginController::class);
});
