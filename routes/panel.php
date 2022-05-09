<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', "PanelController@index")->name('panel');

Route::get('users', 'UserController@index')->name('user.index');

Route::post('users/admin/{user}', 'UserController@toggleAdmin')->name('user.admin.toggle');

Route::resource('products', ProductsController::class);


