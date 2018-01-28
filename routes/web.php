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

Route::get('/upload', function() {
    return view('img_upload');
});

//Route::group(['middleware' => 'auth'], function() {
    Route::Resource('/user_contents', 'UserContentController');
    Route::get('/home', 'HomeController@index')->name('home');        
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
//});

//Auth::routes();