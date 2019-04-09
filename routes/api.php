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
Route::group(['prefix' => 'setup', 'middleware' => 'auth:api'], function() {
	
	Route::resource('/city', 'Api\CityController');

});

// // Township
// Route::resource('/township', 'Api\TownshipController');

// // Position
// Route::resource('/position', 'Api\PositionController');

// // Location
// Route::resource('/location', 'Api\LocationController');

// // Expense
// Route::resource('/expense', 'Api\ExpenseController');

// // Income
// Route::resource('/income', 'Api\IncomeController');

// // Course
// Route::resource('/course', 'Api\CourseController');

// // Duration
// Route::resource('/duration', 'Api\DurationController');

// // Staff
// Route::resource('/staff', 'Api\StaffController');

// // Teacher
// Route::resource('/teacher', 'Api\TeacherController');

// // Section
// Route::resource('/section', 'Api\SectionController');

// // Company
// Route::resource('/company', 'Api\CompanyController');

// // Inquire
// Route::resource('/inquire', 'Api\InquireController');

// // Student
// Route::resource('/student', 'Api\StudentController');

// // Jobcareer
// Route::resource('/jobcareer', 'Api\JobcareerController');

// // Interview
// Route::resource('/interview', 'Api\InterviewController');

// // Hire
// Route::resource('/hire', 'Api\HireController');

// // Dismiss
// Route::resource('/dismiss', 'Api\DismissController');

// // Attendance
// Route::resource('/attendance', 'Api\AttendanceController');