<?php

/*
 * Settings Management
 */
Route::group(['namespace' => 'Settings'], function () {
    Route::resource('settings', 'SettingsController', ['except' => ['show', 'create', 'save', 'index', 'destroy']]);

    Route::post('removeicon', 'SettingsController@removeIcon')->name('removeicon');
});
