<?php

/*
 * Blogs Categories Management
 */
Route::group(['namespace' => 'BlogCategories'], function () {
    Route::resource('blogcategories', 'BlogCategoriesController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogcategories/get', 'BlogCategoriesTableController')
        ->name('blogcategories.get');
});
