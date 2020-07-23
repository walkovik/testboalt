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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'UserController@information');
    Route::apiResource('notifications', 'NotificationController');

    Route::put('notification-status/{id}', 'NotificationController@updateStatus');
});


