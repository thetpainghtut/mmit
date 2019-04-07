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

// City
Route::resource('/city', 'Api\CityController');

// Township
Route::resource('/township', 'Api\TownshipController');

// Position
Route::resource('/city', 'Api\PositionController');

// Location
Route::resource('/city', 'Api\LocationController');

// Expense
Route::resource('/city', 'Api\ExpenseController');

// Income
Route::resource('/city', 'Api\IncomeController');

// Course
Route::resource('/city', 'Api\CourseController');

// Duration
Route::resource('/city', 'Api\DurationController');

// Staff
Route::resource('/city', 'Api\StaffController');

// Teacher
Route::resource('/city', 'Api\TeacherController');

// Section
Route::resource('/city', 'Api\SectionController');

// Company
Route::resource('/city', 'Api\CompanyController');

// Inquire
Route::resource('/city', 'Api\InquireController');

// Student
Route::resource('/city', 'Api\StudentController');

// Jobcareer
Route::resource('/city', 'Api\JobcareerController');

// Interview
Route::resource('/city', 'Api\InterviewController');

// Hire
Route::resource('/city', 'Api\HireController');

// Dismiss
Route::resource('/city', 'Api\DismissController');

// Attendance
Route::resource('/city', 'Api\AttendanceController');