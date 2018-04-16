<?php 

Route::group(['prefix' => 'admin', 'middleware' => ['menu.admin', 'auth']], function () {

    Route::get('services', 'ServicesController@index')->name('services');
    Route::get('services/all', 'ServicesController@all');
    
});