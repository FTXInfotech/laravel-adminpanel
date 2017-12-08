<?php

/*
 * Blogs Management
 */
Route::group(['namespace' => 'Blogs'], function () {
    Route::resource('blogs', 'BlogsController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogs/get', 'BlogsTableController')
       ->name('blogs.get');
});
