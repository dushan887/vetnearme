<?php 

Route::group(['prefix' => 'admin', 'middleware' => ['menu.admin', 'auth']], function () {

    Route::get('services', 'ServicesController@index')->name('services');
    Route::get('services/all', 'ServicesController@all');
    Route::get('services/create', 'ServicesController@create');
    Route::get('services/edit/{id}', 'ServicesController@edit');
    Route::post('services/store', 'ServicesController@store');
    Route::post('services/update/{id}', 'ServicesController@update');
    Route::post('services/destroy/{id}', 'ServicesController@destroy');

    Route::get('clinics', 'ClinicsController@index')->name('clinics');
    
});