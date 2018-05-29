<?php

Route::group(['prefix' => 'admin', 'middleware' => ['menu.admin', 'auth']], function () {

    Route::get('services', 'ServicesController@index')->name('services');
    Route::get('services/all', 'ServicesController@all');
    Route::get('services/create', 'ServicesController@create');
    Route::get('services/edit/{id}', 'ServicesController@edit');
    Route::post('services/store', 'ServicesController@store');
    Route::post('services/update/{id}', 'ServicesController@update');
    Route::post('services/destroy/{id}', 'ServicesController@destroy');

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
    Route::get('profile', 'UsersController@profile')->name('profile');
    Route::get('users/edit', 'UsersController@edit');
    Route::get('users/create', 'UsersController@create');
    Route::post('users/update', 'UsersController@update');

    // CLINICS
    Route::get('clinics', 'ClinicsController@index')->name('clinics');
    Route::get('clinics/show/{id}', 'ClinicsController@show');
    Route::get('clinics/edit/{id}', 'ClinicsController@edit');
    Route::get('clinics/create', 'ClinicsController@create');
    Route::get('clinics/all', 'ClinicsController@all');
    Route::post('clinics/store', 'ClinicsController@store');

    // MEDIA
    Route::get('media', 'MediaController@index')->name('media');
    Route::get('media/all', 'MediaController@all');
    Route::post('media/store', 'MediaController@store');
    Route::post('media/destroy/{id}', 'MediaController@destroy');


    // Blog
    Route::get('blog', 'BlogController@index')->name('blog');
    Route::get('blog/create', 'BlogController@create');


});