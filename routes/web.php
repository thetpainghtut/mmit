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

<<<<<<< HEAD
=======
<<<<<<< HEAD

//Hein
>>>>>>> dc4bb36e88907224060d74d8a986d8ff3c9d57a6
Route::get('/course', 'Course_Controller@index')->name('course');

Route::get('/location', 'Course_Controller@index')->name('location');


<<<<<<< HEAD
Route::get('/duration', 'Duration_Controller@index')->name('duration');
=======
//Chan
Route::get('/teacher', 'TeacherController@index')->name('teacher');
Route::get('/staff', 'StaffController@index')->name('staff');
=======
>>>>>>> dc4bb36e88907224060d74d8a986d8ff3c9d57a6
// City
Route::get('/city', 'HomeController@city')->name('city');

// Township
Route::get('/township', 'HomeController@township')->name('township');

>>>>>>> 6b3fbdffa8c2fad432e8958022288c97a0649c92

