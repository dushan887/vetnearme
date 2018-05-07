<?php

// Admin routes (admin dashboard)
require(base_path() . '/routes/admin.php');

// Site routes (frontend)
require(base_path() . '/routes/front.php');

Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('menu.admin');

Auth::routes();
