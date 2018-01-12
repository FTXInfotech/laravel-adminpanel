<?php

/*
 * Settings Management
 */
Route::group(['namespace' => 'Settings'], function () {
    Route::resource('settings', 'SettingsController', ['except' => ['show', 'create', 'save', 'index', 'destroy']]);

    Route::post('removeicon/{setting}', 'SettingsLogoController@destroy')->name('removeIcon');
});
