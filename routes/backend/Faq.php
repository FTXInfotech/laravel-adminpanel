<?php 

/*
 * Faq Management
 */
Route::group(['namespace' => 'Faqs'], function () {
    Route::resource('faqs', 'FaqsController', ['except' => ['show']]);
});