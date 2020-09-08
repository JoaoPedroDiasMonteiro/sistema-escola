<?php

namespace App\Http\Controllers;

use App\Registry;
use App\Schedule;
use App\Teacher;
use Illuminate\Support\Facades\Response;

class AppController extends Controller
{
    public function index()
    {
        //$registry = new Registry();
        //$registry->run();
        //dd($registry->unrealized());

        $schedule = Schedule::query()->orderBy('teacher', 'asc')
            ->with('teacher')->with('student')
            ->orderBy('weekday', 'asc')->orderBy('hour', 'asc')->limit(10)->get();

        return view('app.index')->with('schedules', $schedule)->with('uri', 'home');
    }

    public function teacher()
    {
        return view('app.teacher.index')->with('uri', 'teacher');
    }

    public function student()
    {
        return view('app.student.index')->with('uri', 'student');
    }
}
