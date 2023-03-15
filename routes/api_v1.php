<?php

use App\Http\Controllers\Api\V1\AdBannerController;
use App\Http\Controllers\Api\V1\ApplicationController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\DestinationController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\api\v1\PackageAmenitiesController;
use App\Http\Controllers\Api\V1\PackageController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\RecommendationController;
use App\Http\Controllers\Api\V1\ReviewController;
use App\Http\Controllers\Api\V1\SouvenirController;
use App\Http\Controllers\Api\V1\TicketerController;
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
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('fcm', [AuthController::class, 'fcm'])->middleware('auth:api');
        Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    });

    //============= ORDER ================
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->middleware('auth:api');
        Route::post('/', [OrderController::class, 'store'])->middleware('auth:api');
    });
    //=============== PAYMENT =============
    Route::group(['prefix' => 'payments'], function () {
        Route::post('/', [PaymentController::class, 'create'])->middleware('auth:api');
        Route::post('/notification', [PaymentController::class, 'notification'])->withoutMiddleware([
            'application.token', 'access.time', 'signature', 'auth:api', \App\Http\Middleware\VerifyCsrfToken::class,
        ]);
    });

    //=========== SOUVENIR ================
    Route::group(['prefix' => 'souvenirs'], function () {
        Route::get('/', [SouvenirController::class, 'index']);
        Route::get('/destination/{destination}', [SouvenirController::class, 'destination']);
        Route::get('/{id}', [SouvenirController::class, 'detail']);
    });
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', [PackageController::class, 'index']);
        Route::get('/{id}', [PackageController::class, 'detail']);
    });

    //=========== Events ================
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', [EventController::class, 'index']);
        Route::get('/{id}', [EventController::class, 'detail']);
    });

    //=========== Explore ================
    Route::group(['prefix' => 'explores'], function () {
        Route::get('/', [ReviewController::class, 'index']);
    });

    //=========== Review ================
    Route::group(['prefix' => 'reviews'], function () {
        Route::post('/', [ReviewController::class, 'add'])->middleware('auth:api');
        Route::get('/', [ReviewController::class, 'waiting'])->middleware('auth:api');
        Route::get('/history', [ReviewController::class, 'history'])->middleware('auth:api');
    });

    //=========== Ticketer ================
    Route::group(['prefix' => 'ticketers', 'middleware' => ['auth:api', 'role:ticketer|admin|super-admin']], function () {
        Route::post('/check', [TicketerController::class, 'check']);
        Route::post('/payment', [TicketerController::class, 'payment']);
        Route::post('/approve', [TicketerController::class, 'approve']);
    });

    //=================== Notification ========================
    Route::group(['prefix' => 'notifications', 'middleware' => ['auth:api']], function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('/paginate', [NotificationController::class, 'paginate']);
        Route::post('/read', [NotificationController::class, 'read']);
        Route::post('/read-all', [NotificationController::class, 'readAll']);
        Route::delete('/delete', [NotificationController::class, 'delete']);
    });

    //======================== Profiles ====================
    Route::group(['prefix' => 'profiles', 'middleware' => ['auth:api']], function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::put('/update', [ProfileController::class, 'update']);
        Route::put('/password', [ProfileController::class, 'password']);
        Route::post('/avatar', [ProfileController::class, 'avatar']);
    });

    //=================== Package Amenities ========================
    Route::group(['prefix' => 'amenities'], function () {
        Route::get('{package}/', [PackageAmenitiesController::class, 'indexPackage']);
        Route::get('/paginate', [PackageAmenitiesController::class, 'paginate']);
        Route::post('/read', [PackageAmenitiesController::class, 'read']);
        Route::post('/read-all', [PackageAmenitiesController::class, 'readAll']);
        Route::delete('/delete', [PackageAmenitiesController::class, 'delete']);
    });
});
