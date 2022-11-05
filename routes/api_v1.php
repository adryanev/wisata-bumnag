<?php

use App\Http\Controllers\Api\V1\AdBannerController;
use App\Http\Controllers\Api\V1\ApplicationController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\DestinationController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\RecommendationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['application.token', 'access.time', 'signature'])->group(function () {
    Route::get('banners', [AdBannerController::class, 'index']);
    Route::get('applications', [ApplicationController::class, 'index']);
    Route::get('recommendations', [RecommendationController::class, 'index']);
    //================ Destination ==========
    Route::group(['prefix' => 'destinations'], function () {
        Route::get('/', [DestinationController::class, 'index']);
        Route::get('/{id}', [DestinationController::class, 'detail']);
    });

    //=============== Catagories ===============
    Route::group(['prefix' => 'categories'], function () {

        Route::get('main', [CategoryController::class, 'main']);
        Route::get('child', [CategoryController::class, 'child']);
    });
    //============= AUTH =================
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
        Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    });

    //============= ORDER ================
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->middleware('auth:api');
        Route::post('/', [OrderController::class, 'store'])->middleware('auth:api');
    });
    Route::group(['prefix' => 'payments'], function () {
        Route::post('/', [PaymentController::class, 'create'])->middleware('auth:api');
        Route::post('/notification', [PaymentController::class, 'notification'])->withoutMiddleware([
            'application.token', 'access.time', 'signature', 'auth:api', \App\Http\Middleware\VerifyCsrfToken::class,
        ]);
    });
});
