<?php

    Route::get('/test', 'Front\FrontPartController@index');
    Route::get('/', 'Front\FrontPartController@index')->name('home');