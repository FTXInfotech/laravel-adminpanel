<?php

/*
 * Blogs Tags Management
 */
Route::group(['namespace' => 'BlogTags'], function () {
    Route::resource('blogtags', 'BlogTagsController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogtags/get', 'BlogTagsTableController')
       ->name('blogtags.get');
});