<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
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
$api = app(Router::class);
$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function (Router $api) {
        /*
        * Register api
        */
        $api->post('register', 'App\\Api\\V1\\Controllers\\RegisterController@Register');
        /*
        * Login api
        */
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');
        /*
        * Recovery password api
        */
        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@forgotpassword');
        /*
        * Reset password api
        */
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetpassword');
        /*
        * Confirm account api
        */
        $api->post('confirm', 'App\\Api\\V1\\Controllers\\RegisterController@confirmAccount');
    });
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->get('userdetails', 'App\Api\V1\Controllers\UserDetailController@userDetails');
    });
    $api->get('cmspage/{page_slug}', 'App\Api\V1\Controllers\CmsPageController@showCmsPage');
});
