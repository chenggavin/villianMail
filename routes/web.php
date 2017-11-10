<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/home', 'PleaseWorkController');

// Route::get('/home', 'PleaseWorkController@index')->name('home');


// Route::get('/home/{message_id}', 'PleaseWorkController@show');


// Route::resource('/home/{$message_id}', 'PleaseWorkController@destroy');


Route::post('/home/{message_id}', 'PleaseWorkController@store');

 Route::resource('/home/{{ $message_id }}/edit', 'PleaseWorkController@edit');

Route::put('/home/{{ message_id }}', 'PleaseWorkController@update');
