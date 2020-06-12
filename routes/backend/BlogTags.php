<?php 

/*
 * Blog Tags Management
 */
Route::group(['namespace' => 'BlogTags', 'prefix' => 'blogs'], function () {
    Route::resource('blog-tags', 'BlogTagsController', ['except' => ['show']]);
});