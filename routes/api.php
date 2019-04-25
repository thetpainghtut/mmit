<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'setup', 'middleware' => 'auth:api'], function() {
	Route::resource('/city', 'Api\CityController');
	Route::resource('/teacher', 'Api\TeacherController');
	Route::resource('/staff', 'Api\StaffController');
	Route::resource('/location', 'Api\LocationController');
	Route::resource('/course', 'Api\CourseController');

});


// Township
Route::resource('/township', 'Api\TownshipController');

Route::group(['prefix' => 'setup', 'middleware' => 'auth:api'], function() {
	// City
	Route::resource('/city', 'Api\CityController');
	
	// Township
	Route::resource('/township', 'Api\TownshipController');


});


// Position
Route::resource('/position', 'Api\PositionController');

// Expense
Route::resource('/expense', 'Api\ExpenseController');

// Income
Route::resource('/income', 'Api\IncomeController');

// Duration
Route::resource('/duration', 'Api\DurationController');

// Staff
Route::resource('/staff', 'Api\StaffController');

// Teacher
Route::resource('/teacher', 'Api\TeacherController');

// Section
Route::resource('/section', 'Api\SectionController');

// Company
Route::resource('/company', 'Api\CompanyController');

// Inquire
Route::resource('/inquire', 'Api\InquireController');

// Student
Route::resource('/student', 'Api\StudentController');

// Jobcareer
Route::resource('/jobcareer', 'Api\JobcareerController');

// Interview
Route::resource('/interview', 'Api\InterviewController');

// Hire
Route::resource('/hire', 'Api\HireController');

// Dismiss
Route::resource('/dismiss', 'Api\DismissController');

// Attendance
Route::resource('/attendance', 'Api\AttendanceController');

//Location
Route::resource('/location', 'Api\LocationController');