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
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'AuthController@login');
    });

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');

            // Password Reset Routes
            Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
            // Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');
        });
        // Users
        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);
        Route::get('deactivatedUsers', 'DeactivatedUsersController@index');
        Route::get('deletedUsers', 'DeletedUsersController@index');

        // Roles
        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);
        // Permission
        Route::resource('permission', 'PermissionController', ['except' => ['create', 'edit']]);

        // Page
        Route::resource('pages', 'PagesController');

        // Faqs
        Route::resource('faqs', 'FaqsController');

        // Blog Categories
        Route::resource('blog_categories', 'BlogCategoriesController', ['except' => ['create', 'edit']]);

        // Blog Tags
        Route::resource('blog_tags', 'BlogTagsController');

        // Blogs
        Route::resource('blogs', 'BlogsController');
    });
});
