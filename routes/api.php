<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * Some public access routes, grouped into 'auth' for convenience.
 */
Route::group(['prefix' => 'auth'], function () {
    // Login.
    Route::post('login', 'Auth\LoginController@login');
    // Register.
    Route::post('register', 'Auth\RegisterController@register');
});

/**
 * Some private access routes, user must be logged into the API in order to access these resources.
 */
Route::group(['middleware' => 'auth:api'], function () {
    // Get user information.
    Route::get('user', 'UserController@information');
    // CRUD for notifications.
    Route::apiResource('notifications', 'NotificationController');
    // Get some data from Yelp API.
    // Route::get('get-yelp-data', 'YelpController');
    // Update Notification status.
    Route::put('notification-status/{id}', 'NotificationController@updateStatus');
});
