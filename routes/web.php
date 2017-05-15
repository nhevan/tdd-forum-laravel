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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::resource('threads', 'ThreadsController', ['except' => [
    'show'
]]);
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('replies.add');
