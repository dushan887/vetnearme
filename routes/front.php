<?php

    Route::get('/', 'Front\FrontPartController@index')->name('home');
    Route::get('/results', 'Front\ResultsController@index')->name('results');
    Route::get('/clinic', 'Front\ClinicPartController@index')->name('clinic');