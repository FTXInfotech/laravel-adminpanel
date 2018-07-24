<?php

/*
 * Notificatons Management
 */
Route::resource('notification', 'NotificationController', ['except' => ['show', 'create', 'store']]);

Route::get('notification/getlist', 'NotificationController@ajaxNotifications')
    ->name('admin.notification.getlist');

Route::get('notification/clearcurrentnotifications', 'NotificationController@clearCurrentNotifications')
    ->name('admin.notification.clearcurrentnotifications');

Route::group(['prefix' => 'notification/{id}', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('mark/{is_read}', 'NotificationController@mark')
        ->name('admin.notification.mark')
        ->where(['is_read' => '[0,1]']);
});
