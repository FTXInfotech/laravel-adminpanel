<?php

/*
 * Blogs Categories Management
 */
Route::group(['namespace' => 'BlogCategories'], function () {
    Route::resource('blogCategories', 'BlogCategoriesController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogCategories/get', 'BlogCategoriesTableController')
        ->name('blogCategories.get');
});
