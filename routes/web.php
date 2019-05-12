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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::view('/', 'welcome')->name('home');

// Statuses routes
Route::get('statuses', 'StatusesController@index')->name('statuses.index');
Route::post('statuses', 'StatusesController@store')->name('statuses.store')->middleware('auth');

// Statuses Likes routes
Route::post('statuses/{status}/likes', 'StatusLikesController@store')->name('statuses.likes.store')->middleware('auth');
Route::delete('statuses/{status}/likes', 'StatusLikesController@destroy')->name('statuses.likes.destroy')->middleware('auth');

// Statuses Comments routes
Route::post('statuses/{status}/comments', 'StatusCommentsController@store')->name('statuses.comments.store')->middleware('auth');

// Comments like route
Route::post('comments/{comment}/likes', 'CommentLikesController@store')->name('comments.likes.store')->middleware('auth');
Route::delete('comments/{comment}/likes', 'CommentLikesController@destroy')->name('comments.likes.destroy')->middleware('auth');

// Users routes
Route::get('@{user}', 'UsersController@show')->name('users.show');

// Users statuses routes
Route::get('users/{user}/statuses', 'UsersStatusController@index')->name('users.statuses.index');

// Citas routes
Route::post('citas/{recipient}', 'CitasController@store')->name('citas.store')->middleware('auth');
Route::delete('citas/{recipient}', 'CitasController@destroy')->name('citas.destroy')->middleware('auth');

// Request citas routes
Route::post('accept-citas/{sender}', 'AcceptCitasController@store')->name('accept-citas.store')->middleware('auth');
Route::delete('accept-citas/{sender}', 'AcceptCitasController@destroy')->name('accept-citas.destroy')->middleware('auth');

Route::auth();
