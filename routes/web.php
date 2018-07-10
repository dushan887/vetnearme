<?php

Route::fallback(function(){
    return response()->view('errors/404', [], 404);
});

Route::get('changePassword', 'PasswordController@index')->name('changePassword');
Route::post('/password/update', 'PasswordController@update');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

// Admin routes (admin dashboard)
require(base_path() . '/routes/admin.php');

// Site routes (frontend)
require(base_path() . '/routes/front.php');
