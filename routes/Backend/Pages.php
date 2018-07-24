<?php

/*
 * CMS Pages Management
 */
Route::group(['namespace' => 'Pages'], function () {
    Route::resource('pages', 'PagesController', ['except' => ['show']]);

    //For DataTables
    Route::post('pages/get', 'PagesTableController')->name('pages.get');
});
