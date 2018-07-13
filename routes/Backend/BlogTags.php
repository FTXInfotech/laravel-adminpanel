<?php

/*
 * Blogs Tags Management
 */
Route::group(['namespace' => 'BlogTags'], function () {
    Route::resource('blogTags', 'BlogTagsController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogTags/get', 'BlogTagsTableController')
       ->name('blogTags.get');
});
