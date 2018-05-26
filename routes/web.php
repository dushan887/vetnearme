<?php

Route::get('/', 'DashboardController@index')->middleware('menu.admin')->name('home');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

// Admin routes (admin dashboard)
require(base_path() . '/routes/admin.php');

// Site routes (frontend)
require(base_path() . '/routes/front.php');
