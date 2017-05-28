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
Route::resource('threads', 'ThreadsController', ['except' => [
    'show', 'delete'
]]);
Route::get('/threads/{channel}', 'ThreadsController@index')->name('channels.threads');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy')->name('threads.destroy');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('replies.add');

Route::post('/replies/{reply}/favorites', 'FavoritesController@store');

Route::get('/profile/{user}', 'ProfilesController@show')->name('profile');
