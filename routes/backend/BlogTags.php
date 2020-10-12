<?php

// Blog Tags Management
Route::group(['namespace' => 'BlogTags', 'prefix' => 'blogs'], function () {
    Route::resource('blog-tags', 'BlogTagsController', ['except' => ['show']]);

    //For DataTables
    Route::post('blog-tags/get', 'BlogTagsTableController')
        ->name('blogTags.get');
});
