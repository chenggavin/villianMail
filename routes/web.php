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

Route::get('/home', 'PleaseWorkController@index')->name('home');


Route::get('/home/{message_id}', 'PleaseWorkController@show');//->name('home');


Route::delete('/home/{{ $message_id }}/delete', 'PleaseWorkController@destroy');


Route::post('/home/{message_id}', 'PleaseWorkController@store');//->name('home');

// Route::resource('/home/edit/{{ $message_id }}', 'PleaseWorkController@edit');//->name('home');

//Route::put('/home/edit/{{ message_id }}', 'PleaseWorkController@edit');//->name('home');
