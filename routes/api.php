<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


/*
|--------------------------------------------------------------------------
| Schedule Routes
|--------------------------------------------------------------------------
 */

Route::resource('v2/schedule', \API\ScheduleController::class);

Route::get('v2/schedule/search/{search}', [App\Http\Controllers\API\ScheduleController::class, 'search'])
    ->name('schedule.search');

Route::get('v2/schedule/weekday/{weekday}', [App\Http\Controllers\API\ScheduleController::class, 'weekday'])
    ->name('schedule.weekday');

Route::get('v2/schedule/weekday/{weekday}/{search}', [App\Http\Controllers\API\ScheduleController::class, 'weekdaySearch'])
    ->name('schedule.weekday.search');


/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
 */

Route::resource('v2/teacher', \API\TeacherController::class);

Route::get('v2/teacher/search/{search}', [App\Http\Controllers\API\ScheduleController::class, 'search'])
    ->name('teacher.search');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
 */

Route::resource('v2/student', \API\StudentController::class);

Route::get('v2/student/search/{search}', [App\Http\Controllers\API\ScheduleController::class, 'search'])
    ->name('student.search');
