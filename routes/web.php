<?php

Route::get('/', 'DashboardController@index')->middleware(['menu.admin', 'tempPass', 'auth'])->name('home');

Route::get('changePassword', 'PasswordController@index')->name('changePassword');
Route::post('/password/update', 'PasswordController@update');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

// Admin routes (admin dashboard)
require(base_path() . '/routes/admin.php');

// Site routes (frontend)
require(base_path() . '/routes/front.php');
