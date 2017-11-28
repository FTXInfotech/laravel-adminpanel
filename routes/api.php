<?php


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

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', 'AuthController@authenticate');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/check', 'AuthController@check');
        Route::post('/register', 'AuthController@register');
        Route::get('/activate/{token}', 'AuthController@activate');
        Route::post('/password', 'AuthController@password');
        Route::post('/validate-password-reset', 'AuthController@validatePasswordReset');
        Route::post('/reset', 'AuthController@reset');
    });
});
