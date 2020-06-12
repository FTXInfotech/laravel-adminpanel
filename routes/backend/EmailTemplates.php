<?php 

/*
 * EmailTemplate Management
 */
Route::group(['namespace' => 'EmailTemplates'], function () {
    Route::resource('email-templates', 'EmailTemplatesController', ['except' => ['show']]);
});