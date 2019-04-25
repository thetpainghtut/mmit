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


//Hein
Route::get('/course', 'Course_Controller@index')->name('course');

Route::get('/location', 'Course_Controller@index')->name('location');


//Chan
Route::get('/teacher', 'TeacherController@index')->name('teacher');
Route::get('/staff', 'StaffController@index')->name('staff');
// City
Route::get('/city', 'HomeController@city')->name('city');

// Township
Route::get('/township', 'HomeController@township')->name('township');


