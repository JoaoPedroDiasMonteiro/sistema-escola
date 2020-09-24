<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('app.schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $students = Student::query()->orderBy('name', 'asc')->get();
        $teachers = Teacher::query()->orderBy('name', 'asc')->get();

        return view('app.schedule.new', ['teachers' => $teachers, 'students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->teacher = $request->teacher;
        $schedule->student = $request->student;
        $schedule->weekday = $request->weekday;
        $schedule->hour = $request->hour;

        if (!$schedule->save()) {
            echo "<script>alert('Error on create');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Schedule created');</script>";
        echo "<script>window.close();</script>";
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Schedule $schedule)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Schedule $schedule)
    {
        $teachers = Teacher::all();
        $students = Student::query()->orderBy('name', 'asc')->get();

        return view('app.schedule.edit', [
            'schedule' => $schedule,
            'teachers' => $teachers,
            'students' => $students
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Schedule $schedule
     * @return bool
     */
    public function update(Request $request, Schedule $schedule)
    {
        $schedule->teacher = $request->teacher;
        $schedule->student = $request->student;
        $schedule->weekday = $request->weekday;
        $schedule->hour = $request->hour;

        if (!$schedule->save()) {
            echo "<script>alert('Error on update');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Schedule Updated');</script>";
        echo "<script>window.close();</script>";
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Schedule $schedule
     * @return bool
     * @throws \Exception
     */
    public function destroy(Schedule $schedule)
    {
        if (!$schedule->delete()) {
            echo "<script>alert('Error on delete');</script>";
            echo "<script>window.close();</script>";
            return false;
        }
        echo "<script>alert('Schedule Deleted');</script>";
        echo "<script>window.close();</script>";
        return true;
    }
}
