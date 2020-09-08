<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'AppController@index');
Route::get('/teachers', 'AppController@teacher');
Route::get('/students', 'AppController@student');


Route::get('/schedule/edit/{schedule}', 'ScheduleController@edit');
Route::get('/schedule/delete/{schedule}', function (\Illuminate\Http\Request $request){
    return view('app.scheduleDelete', ['schedule' => $request->schedule]);
});
Route::get('/schedules/new', 'ScheduleController@create');



Route::get('/teacher/edit/{teacher}', 'TeacherController@edit');
Route::get('/teacher/delete/{teacher}', function (\Illuminate\Http\Request $request){
    return view('app.teacher.delete', ['teacher' => $request->teacher]);
});
Route::get('/teachers/new', 'TeacherController@create');



Route::get('/student/edit/{student}', 'StudentController@edit');
Route::get('/student/delete/{student}', function (\Illuminate\Http\Request $request){
    return view('app.student.delete', ['student' => $request->student]);
});
Route::get('/students/new', 'StudentController@create');



Route::get('/api/schedule', 'ScheduleController@index');
Route::get('/api/schedule/all', 'ScheduleController@all');
Route::get('/api/schedule/weekday/{weekday}', 'ScheduleController@weekday');
Route::get('/api/schedule/weekday/{weekday}/all', 'ScheduleController@weekdayAll');
Route::put('api/schedule/edit/{schedule}', 'ScheduleController@update');
Route::delete('api/schedule/delete/{schedule}', 'ScheduleController@destroy');
Route::post('api/schedule/new', 'ScheduleController@store');

Route::get('/api/teacher', 'TeacherController@index');
Route::get('/api/teacher/all', 'TeacherController@all');
Route::put('api/teacher/edit/{teacher}', 'TeacherController@update');
Route::delete('api/teacher/delete/{teacher}', 'TeacherController@destroy');
Route::post('api/teacher/new', 'TeacherController@store');

Route::get('/api/student', 'StudentController@index');
Route::get('/api/student/all', 'StudentController@all');
Route::put('api/student/edit/{student}', 'StudentController@update');
Route::delete('api/student/delete/{student}', 'StudentController@destroy');
Route::post('api/student/new', 'StudentController@store');

