<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::post('/get/states', 'DashboardController@getStates')->name('get.states');
Route::post('/get/cities', 'DashboardController@getCities')->name('get.cities');
Route::post('get-permission', 'DashboardController@getPermissionByRole')->name('get.permission');

/*
 * Edit Profile
*/
Route::get('profile/edit', 'DashboardController@editProfile')->name('profile.edit');
Route::patch('profile/update', 'DashboardController@updateProfile')
    ->name('profile.update');

/*
 * General Slug generator
 */
Route::any('generateSlug', function (\Illuminate\Http\Request $request) {
    return str_slug($request['text']);
})->name('generate.slug');

/*
 * Email Templates Management
 */
Route::group(['namespace' => 'EmailTemplates'], function () {
    Route::resource('emailtemplates', 'EmailTemplatesController', ['except' => ['show', 'create', 'save']]);

    //For DataTables
    Route::post('emailtemplates/get', 'EmailTemplatesTableController')
        ->name('emailtemplates.get');
});

/*
 * Settings Management
 */
Route::group(['namespace' => 'Settings'], function () {
    Route::resource('settings', 'SettingsController', ['except' => ['show', 'create', 'save', 'index', 'destroy']]);
    Route::post('removeicon', 'SettingsController@removeIcon')->name('removeicon');
});

/*
 * Blogs Categories Management
 */
Route::group(['namespace' => 'BlogCategories'], function () {
    Route::resource('blogcategories', 'BlogCategoriesController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogcategories/get', 'BlogCategoriesTableController')
        ->name('blogcategories.get');
});

/*
 * Blogs Tags Management
 */
Route::group(['namespace' => 'BlogTags'], function () {
    Route::resource('blogtags', 'BlogTagsController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogtags/get', 'BlogTagsTableController')
       ->name('blogtags.get');
});

/*
 * Blogs Management
 */
Route::group(['namespace' => 'Blogs'], function () {
    Route::resource('blogs', 'BlogsController', ['except' => ['show']]);

    //For DataTables
    Route::post('blogs/get', 'BlogsTableController')
       ->name('blogs.get');
});

/*
 * Faqs Management
 */
Route::group(['namespace' => 'Faqs'], function () {
    Route::resource('faqs', 'FaqsController', ['except' => ['show']]);

    //For DataTables
    Route::post('faqs/get', 'FaqsTableController')->name('faqs.get');

    // Status
    Route::get('faqs/{id}/mark/{status}', 'FaqsController@mark')->name('faqs.mark')->where(['status' => '[0,1]']);
});

/*
 * Notificatons Management
 */
Route::resource('notification', 'NotificationController', ['except' => ['show', 'create', 'store']]);
Route::get('notification/getlist', 'NotificationController@ajaxNotifications')->name('admin.notification.getlist');
Route::get('notification/clearcurrentnotifications', 'NotificationController@clearCurrentNotifications')->name('admin.notification.clearcurrentnotifications');
Route::group(['prefix' => 'notification/{id}', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('mark/{is_read}', 'NotificationController@mark')->name('admin.notification.mark')->where(['is_read' => '[0,1]']);
});
