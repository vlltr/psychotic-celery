<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\Auth;

Route::prefix('v1')->group(function () {
    //Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('register', Auth\RegisterController::class);
        Route::post('login', Auth\LoginController::class);
        Route::post('logout', Auth\LogoutController::class)->middleware('auth:sanctum');
    });
    //Get Zones route
    Route::get('zones', [\App\Http\Controllers\Api\V1\ZoneController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        //Profile routes
        Route::get('profile', [Auth\ProfileController::class, 'show']);
        Route::put('profile', [Auth\ProfileController::class, 'update']);
        Route::put('password', Auth\PasswordUpdateController::class);
        //Vehicle routes
        Route::apiResource('vehicles', \App\Http\Controllers\Api\V1\VehicleController::class);
        //Parking routes
        Route::post('parking/start', [\App\Http\Controllers\Api\V1\ParkingController::class, 'start']);
        Route::get('parking/{parking}', [\App\Http\Controllers\Api\V1\ParkingController::class, 'show']);
        Route::put('parking/{parking}', [\App\Http\Controllers\Api\V1\ParkingController::class, 'stop']);
    });
});
