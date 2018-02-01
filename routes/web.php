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

Auth::routes();

//Route::group(['middleware' => 'auth'], function() {
    Route::Resource('/user_contents', 'UserContentController');
    Route::Resource('/user', 'UserController');
    Route::get('/home', function () {
        return redirect('/user_contents?first=true');
    });
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::get('/getTagWiseCount', 'DataAnalysisController@getDistinctTags');
    //Route::get('/getDistinctTags', 'DataAnalysisController@getDistinctTags');
    Route::get('/translateDemo', 'TranslatorController@translate');
//});