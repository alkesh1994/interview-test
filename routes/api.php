<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {

    //flight
    Route::group(['prefix' => 'flights'], function () {
        Route::get('/', 'FlightController@index');
        Route::get('/generate', 'FlightController@generate');
    });

    //flight
    Route::group(['prefix' => 'registration'], function () {
        Route::post('/', 'RegistrationController@create');
        Route::get('/check', 'RegistrationController@isRegistered');
    });

    Route::group(['prefix' => 'passengers'], function () {
        Route::post('/', 'PassengerController@create');
    });
});
