<?php 

/*
 * Pages Management
 */
Route::group(['namespace' => 'Pages'], function () {
    Route::resource('pages', 'PagesController', ['except' => ['show']]);
});