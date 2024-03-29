<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\Media;

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes([
    'register' => false,
]);


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'LandingController@index')->name('landing');
Route::get('/term-and-conditions', 'LandingController@termAndConditions')->name('tnc');
Route::get('/privacy-policy', 'LandingController@privacyPolicy')->name('privacy-policy');
/*
|------------------------------------------------------------------------------------
| Admin
|------------------------------------------------------------------------------------
*/
Route::group(['prefix' => ADMIN, 'as' => ADMIN . '.', 'middleware' => ['auth', 'role:super-admin|admin']], function () {
    Route::get('/', 'DashboardController@index')->name('dash');
    Route::resource('users', 'UserController');
    Route::resource('destinations', 'DestinationController');
    Route::resource('adbanners', 'AdBannerController');
    Route::resource('souvenirs', 'SouvenirController');
    Route::resource('tickets', 'TicketController');
    Route::resource('packages', 'PackageController');
    Route::resource('orders', 'OrderController');
    Route::group(['prefix' => 'orders', 'as' => 'orders' . '.'], function () {
        Route::get('/paid/{id}', 'OrderController@paid')->name('paid');
        Route::get('/cancel/{id}', 'OrderController@cancel')->name('cancel');
        Route::get('/complete/{id}', 'OrderController@complete')->name('complete');
        Route::get('/refund/{id}', 'OrderController@refund')->name('refund');
    });
    Route::resource('events', 'EventController');
    Route::resource('reviews', 'ReviewController');
    Route::resource('medias', 'MediaController');
    Route::group(['prefix' => 'profiles', 'as' => 'profiles' . '.'], function () {
        Route::get('/', 'ProfileController@show')->name('show');
        Route::get('/edit', 'ProfileController@edit')->name('edit');
        Route::put('/update-profile/{id}', 'ProfileController@updateProfile')->name('update-profile');
        Route::put('/update-password/{id}', 'ProfileController@updatePassword')->name('update-password');
    });
    Route::group(['prefix' => 'notifications', 'as' => 'notifications' . '.'], function () {
        Route::get('/', 'NotificationController@index')->name('index');
        Route::get('/read/{id}', 'NotificationController@read')->name('read');
        Route::get('/readall', 'NotificationController@readAll')->name('read-all');
    });
    Route::resource('recommendations', 'RecommendationController');
    Route::resource('categories', 'CategoryController');
    Route::resource('amenities', 'PackageAmenitiesController');
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});
