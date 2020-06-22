<?php

    Route::get('/', 'Front\FrontPartController@index')->name('home');
    Route::get('/results', 'Front\ResultsController@index')->name('results');
    Route::get('/vet-clinic/{clinic}', 'Front\ClinicController@index')->name('clinic');
    // old clinic url redirecting to new
    Route::get('/clinic/{clinic}', 'Front\ClinicController@old_clinic_url')->name('old-clinic-url');

    Route::get('/blog', 'Front\BlogController@index')->name('blog');
    Route::get('/privacy-policy', 'Front\PrivacyController@index')->name('privacy');
    Route::get('/sitemap', 'Front\SiteMapController@index')->name('sitemap');

    Route::get('/{slug}', 'Front\BlogController@show')->name('blog-single');

    Route::get('/blog/category/{name}', 'Front\BlogController@category')->name('blog-categories');