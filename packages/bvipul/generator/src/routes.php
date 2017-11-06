<?php

Route::group(['namespace' => 'Bvipul\Generator\Controllers', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'admin'] ], function () {
	Route::resource('modules', 'ModuleController');

    //For DataTables
    Route::post('modules/get', 'ModuleTableController')
        ->name('modules.get');
    //Checking namespace exists (file exists)
    Route::post('modules/checkNamespace', 'ModuleController@checkNamespace')->name('modules.check.namespace');
    //checking table exists
    Route::post('modules/checkTable', 'ModuleController@checkTable')->name('modules.check.table');
    //checking permission exists
    Route::post('modules/checkPermission', 'ModuleController@checkPermission')->name('modules.check.permission');
});