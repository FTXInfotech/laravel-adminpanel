<?php

// Faq Management
Route::group(['namespace' => 'Faqs'], function () {
    Route::resource('faqs', 'FaqsController', ['except' => ['show']]);

    //For DataTables
    Route::post('faqs/get', 'FaqsTableController')->name('faqs.get');
});
