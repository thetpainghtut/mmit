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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/course', 'Course_Controller@index')->name('course');

Route::get('/location', 'Location_Controller@index')->name('location');

Route::get('/duration', 'Duration_Controller@index')->name('duration');
// City
Route::get('/city', 'HomeController@city')->name('city');

// Township
Route::get('/township', 'HomeController@township')->name('township');


