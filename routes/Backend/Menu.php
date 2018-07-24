<?php
/**
 * Menu Management.
 */
Route::group(['namespace' => 'Menu'], function () {
    Route::resource('menus', 'MenuController', ['except' => []]);
    //For DataTables
    Route::post('menus/get', 'MenuTableController')->name('menus.get');
    // for Model Forms
    Route::get('menus/get-form/{name?}', 'MenuFormController@create')->name('menus.getform');
});
