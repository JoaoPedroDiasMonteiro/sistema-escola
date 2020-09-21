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

Route::get('/', function () {
    return view('app.app');
});

Route::resources([
    'schedule' => ScheduleController::class,
    'teacher' => TeacherController::class,
    'student' => StudentController::class,
]);

Route::get('schedule/delete/{schedule}', function (\Illuminate\Http\Request $request) {
    return view('app.schedule.delete', ['schedule' => $request->schedule]);
});

Route::get('teacher/delete/{teacher}', function (\Illuminate\Http\Request $request) {
    return view('app.teacher.delete', ['teacher' => $request->teacher]);
});

Route::get('student/delete/{student}', function (\Illuminate\Http\Request $request) {
    return view('app.student.delete', ['student' => $request->student]);
});
