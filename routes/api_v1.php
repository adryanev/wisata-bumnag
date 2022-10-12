<?php

use App\Http\Controllers\Api\V1\AdBannerController;
use App\Http\Controllers\Api\V1\ApplicationController;
use App\Http\Controllers\Api\V1\DestinationController;
use App\Models\AdBanner;

Route::middleware(['application.token', 'access.time', 'signature'])->group(function () {
    Route::get('banners', [AdBannerController::class, 'index']);
    Route::get('/', function () {
        return response('data');
    });
    Route::get('applications', [ApplicationController::class, 'index']);
    Route::get('destinations', [DestinationController::class, 'index']);
});
