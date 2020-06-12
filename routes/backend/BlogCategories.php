<?php 

/*
 * Blog Categories Management
 */
Route::group(['namespace' => 'BlogCategories', 'prefix' => 'blogs'], function () {
    Route::resource('blog-categories', 'BlogCategoriesController', ['except' => ['show']]);
});