<?php

    Route::get('/', 'Front\FrontPartController@index')->name('home');
    Route::get('/results', 'Front\ResultsController@index')->name('results');
    Route::get('/clinic/{clinic}', 'Front\ClinicController@index')->name('clinic');

    Route::get('/blog', 'Front\BlogController@index')->name('blog');
    Route::get('/blogsingle', 'Front\BlogController@blogsingle')->name('blog-single');

    Route::get('/blog/pet-health', 'Front\BlogController@category')->name('Pet Health');
    Route::get('/blog/medical-bulletin', 'Front\BlogController@category2')->name('Medical Bulletin');
    Route::get('/blog/veterinary', 'Front\BlogController@category3')->name('Veterinary');

    Route::get('/blog/fireworks-top-10-tips', 'Front\BlogController@post')->name('Fireworks - top 10 tips!');
    Route::get('/blog/ticks-the-quiet-killers', 'Front\BlogController@post')->name('Ticks - the quiet killers!');
    Route::get('/blog/beware-of-snakes', 'Front\BlogController@post')->name('Beware of snakes');
    Route::get('/blog/tooth-brushing-in-dogs-and-cats', 'Front\BlogController@post')->name('Tooth brushing in dogs and cats');
    Route::get('/blog/feline-aids-is-your-cat-protected', 'Front\BlogController@post')->name('Feline AIDS - Is your cat protected?');
    Route::get('/blog/chicken-raw-or-cooked', 'Front\BlogController@post')->name('Chicken - Raw or cooked?');
    Route::get('/blog/courteous-cats', 'Front\BlogController@post')->name('Courteous cats');
    Route::get('/blog/new-budgie-or-cockatiel', 'Front\BlogController@post')->name('New Budgie or Cockatiel');
    Route::get('/blog/taking-pets-overseas', 'Front\BlogController@post')->name('Taking Pets Overseas?');










