<?php

    Route::get('/', 'Front\FrontPartController@index')->name('home');
    Route::get('/results', 'Front\ResultsController@index')->name('results');
    Route::get('/clinic/{clinic}', 'Front\ClinicController@index')->name('clinic');

    Route::get('/blog', 'Front\BlogController@index')->name('blog');

    Route::get('/blog/{slug}', 'Front\BlogController@show')->name('blog-single');

    Route::get('/blog/category/{name}', 'Front\BlogController@category')->name('blog-categories');
