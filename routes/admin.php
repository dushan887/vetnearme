<?php

Route::group(['prefix' => 'admin', 'middleware' => ['menu.admin', 'auth', 'tempPass']], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('services', 'ServicesController@index')->name('services');
    Route::get('services/all', 'ServicesController@all');
    Route::get('services/create', 'ServicesController@create');
    Route::get('services/edit/{id}', 'ServicesController@edit');
    Route::post('services/store', 'ServicesController@store');
    Route::post('services/changePriorityStatus/{id}', 'ServicesController@changePriorityStatus');
    Route::post('services/update/{id}', 'ServicesController@update');
    Route::post('services/destroy/{id}', 'ServicesController@destroy');

    // MESSAGES
    // Route::get('mailbox', 'MailboxController@index')->name('mailbox');
    // Route::get('mailbox/compose', 'MailboxController@compose');
    // Route::get('mailbox/message', 'MailboxController@message');

    // NOTIFICATIONS
    // Route::get('notifications', 'NotificationsController@index')->name('notifications');
    // Route::get('notifications/compose', 'NotificationsController@compose');
    // Route::get('notifications/notification', 'NotificationsController@notification');

    // USERS
    Route::get('profile', 'UsersController@profile')->name('profile');
    Route::get('users', 'UsersController@index')->name('users');
    Route::get('users/edit/{id}', 'UsersController@edit');
    Route::get('users/create', 'UsersController@create');
    Route::post('users/destroy/{id}', 'UsersController@destroy');
    Route::post('users/store', 'UsersController@store');
    Route::post('users/update/{id?}', 'UsersController@update');

    // CLINICS
    Route::get('clinics', 'ClinicsController@index')->name('clinics')->middleware('checkRole:super_admin');
    Route::get('my-clinic', 'ClinicsController@index')->name('my-clinic');
    Route::get('clinics/show/{id}', 'ClinicsController@show')->middleware('checkRole:super_admin');
    Route::get('clinics/edit/{id?}', 'ClinicsController@edit');
    Route::get('clinics/create', 'ClinicsController@create');
    Route::get('clinics/get/', 'ClinicsController@get');
    Route::get('clinics/export', 'ClinicsController@export')->middleware('checkRole:super_admin');
    Route::post('clinics/store', 'ClinicsController@store');
    Route::post('clinics/update/{id?}', 'ClinicsController@update');
    Route::post('clinics/destroy/{id}', 'ClinicsController@destroy')->middleware('checkRole:super_admin');

    // MEDIA
    Route::get('media', 'MediaController@index')->name('media');
    Route::get('media/all', 'MediaController@all');
    Route::post('media/store', 'MediaController@store');
    Route::post('media/galleryUpdate', 'MediaController@galleryUpdate')->middleware('checkRole:admin');
    Route::post('media/destroy/{id}', 'MediaController@destroy');

    // Clinic Images
    Route::get('clinic-gallery/get-clinics', 'ClinicGalleryController@getClinics')->middleware('checkRole:super_admin');
    Route::post('clinic-gallery/store', 'ClinicGalleryController@store');

    // Post
    Route::get('posts', 'PostController@index')->name('posts');
    Route::get('posts/create', 'PostController@create');
    Route::get('posts/get/{id}', 'PostController@get');
    Route::get('posts/edit/{id}', 'PostController@edit');
    Route::post('posts/store', 'PostController@store');
    Route::post('posts/update/{id}', 'PostController@update');
    Route::post('posts/destroy/{id}', 'PostController@destroy');

    // Post Categories
    Route::get('post-categories', 'PostCategoryController@index')->name('post-categories');
    Route::get('post-categories/all', 'PostCategoryController@all');
    Route::get('post-categories/edit/{id}', 'PostCategoryController@edit');
    Route::get('post-categories/create', 'PostCategoryController@create');
    Route::post('post-categories/store', 'PostCategoryController@store');
    Route::post('post-categories/update/{id}', 'PostCategoryController@update');
    Route::post('post-categories/destroy/{id}', 'PostCategoryController@destroy');


});