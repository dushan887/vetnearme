<?php 

Route::group(['prefix' => 'admin', 'middleware' => 'menu.admin'], function () {

    Route::get('home', function () {
        return view('home');
    });
    
});