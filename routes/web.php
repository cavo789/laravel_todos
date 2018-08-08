<?php

// Enable authentication routes
Auth::routes();

// Register http://127.0.0.1:8000/login and display the login screen
Route::get('home', 'HomeController@index')->name('home');

// Register the http://127.0.0.1:8000/logout and logout
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// -------------------

// Attach the controller to every actions (GET, HEAD, POST, DELETE, ...)
// for the "todos" resource. Use "php artisan route:list" to retrieve all
// routes created by this Route::resource() statement.
Route::resource('todos', 'TodoController');

// Default homepage : show the list of todos
Route::get('/', 'TodoController@index');

// Enable authentication routes
Auth::routes();

// Register http://127.0.0.1:8000/login and display the login screen
Route::get('home', 'HomeController@index')->name('home');

// Register the http://127.0.0.1:8000/logout and logout
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// -------------------

// Attach the controller to every actions (GET, HEAD, POST, DELETE, ...)
// for the "todos" resource. Use "php artisan route:list" to retrieve all
// routes created by this Route::resource() statement.
Route::resource('todos', 'TodoController');

// Default homepage : show the list of todos
Route::get('/', 'TodoController@index');

// Only when debugging
if (env('APP_DEBUG', false)) {
	// Get access to the Laravel log files
	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
	// Get access to informations about the system and installed packages
	Route::get('decompose', '\Lubusin\Decomposer\Controllers\DecomposerController@index');
}
