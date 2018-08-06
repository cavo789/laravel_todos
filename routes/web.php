<?php

// Enable authentication routes
Auth::routes();

// Register http://127.0.0.1:8000/login and display the login screen
Route::get('home', 'HomeController@index')->name('home');

// Register the http://127.0.0.1:8000/logout and logout
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware('auth');

// -------------------

// Attach the controller to every actions (GET, HEAD, POST, DELETE, ...)
// for the "todos" resource. Use "php artisan route:list" to retrieve all
// routes created by this Route::resource() statement.
Route::resource('todos', 'TodoController')->middleware('auth');

// Default homepage : show the list of todos
Route::get('/', 'TodoController@index');
