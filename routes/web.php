<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();


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
    Route::group(['prefix' => 'orders','as' => 'orders'.'.'], function () {
        Route::get('/paid/{id}', 'OrderController@paid')->name('paid');
        Route::get('/cancel/{id}', 'OrderController@cancel')->name('cancel');
        Route::get('/complete/{id}', 'OrderController@complete')->name('complete');
        Route::get('/refund/{id}', 'OrderController@refund')->name('refund');
    });
    Route::resource('events', 'EventController');
    Route::resource('reviews', 'ReviewController');
});

Route::get('/', function () {
    return redirect(route('admin.dash'));
});
