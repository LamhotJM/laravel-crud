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

Route::get('/home', 'HomeController@index');

//Middleware Group
Route::group(['middleware' => 'auth'], function(){
	Route::get('/home/post', 'PostController@index')->name('post.index');	
	Route::post('/home/post', 'PostController@store')->name('post.create');
	Route::delete('/home/post/{post}', 'PostController@destroy')->name('post.destroy');
	Route::patch('/home/post/{post}', 'PostController@update')->name('post.update');
});
