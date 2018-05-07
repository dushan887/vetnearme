<?php

Route::group(['prefix' => 'admin', 'middleware' => ['menu.admin', 'auth']], function () {

    Route::get('services', 'ServicesController@index')->name('services');
    Route::get('services/all', 'ServicesController@all');
    Route::get('services/create', 'ServicesController@create');
    Route::get('services/edit/{id}', 'ServicesController@edit');
    Route::post('services/store', 'ServicesController@store');
    Route::post('services/update/{id}', 'ServicesController@update');
    Route::post('services/destroy/{id}', 'ServicesController@destroy');

    // USER
    Route::get('user', 'UserController@index')->name('user');

    // MESSAGES
    Route::get('mailbox', 'MailboxController@index')->name('mailbox');
    Route::get('mailbox/compose', 'MailboxController@compose');
    Route::get('mailbox/message', 'MailboxController@message');

    // NOTIFICATIONS
    Route::get('notifications', 'NotificationsController@index')->name('notifications');
    Route::get('notifications/compose', 'NotificationsController@compose');
    Route::get('notifications/notification', 'NotificationsController@notification');

    // USERS
    Route::get('users', 'UsersController@index')->name('users');
    Route::get('users/edit_user', 'UsersController@edit_user');
    Route::get('users/new_user', 'UsersController@new_user');

    // CLINICS
    Route::get('clinics', 'ClinicsController@index')->name('clinics');

    // Blog
    Route::get('blog', 'BlogController@index')->name('blog');


});