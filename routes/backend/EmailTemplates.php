<?php

// EmailTemplate Management
Route::group(['namespace' => 'EmailTemplates'], function () {
    Route::resource('email-templates', 'EmailTemplatesController', ['except' => ['show']]);

    //For DataTables
    Route::post('email-templates/get', 'EmailTemplatesTableController')
        ->name('emailTemplates.get');
});
