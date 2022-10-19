<?php

use App\Http\Controllers\Api\V1\AdBannerController;
use App\Http\Controllers\Api\V1\ApplicationController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DestinationController;
use App\Models\AdBanner;

Route::middleware(['application.token', 'access.time', 'signature'])->group(function () {
    Route::get('banners', [AdBannerController::class, 'index']);
    Route::get('/', function () {
        return response('data');
    });
    Route::get('applications', [ApplicationController::class, 'index']);
    Route::get('destinations', [DestinationController::class, 'index']);
    //============= AUTH =================
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
    // Route::controller(AuthController::class)->group(function () {
    //     Route::post('login', 'login');
    //     Route::post('register', 'register');
    //     Route::post('logout', 'logout');
    //     Route::post('refresh', 'refresh');
    // });
});
