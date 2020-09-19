<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Schedule;
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
        $schedule = Schedule::query()->with('teacher')->orderBy('teacher', 'asc')
            ->orderBy('weekday', 'asc')->orderBy('hour', 'asc')
            ->with('student')->paginate(60);


        foreach ($schedule as $item) {
            $item->teacherName = $item->teacher()->first()->name;
            $item->studentName = $item->student()->first()->name;
        }

        return Response::json($schedule, 200);
    }

    /**
     * Display a listing of the resource filtered by search key.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $schedule = Schedule::query()
            ->orWhere('weekday', 'LIKE', "%{$request->search}%")
            ->orWhereHas('teacher', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%");
            })
            ->orWhereHas('student', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%");
            })
            ->orWhere('hour', 'LIKE',"%{$request->search}%")->paginate(60);

        foreach ($schedule as $item) {
            $item->teacherName = $item->teacher()->first()->name;
            $item->studentName = $item->student()->first()->name;
        }

        return Response::json($schedule, 200);
    }

    /**
     * Display a listing of the resource filtered by weekday.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function weekday(Request $request)
    {
        $schedule = Schedule::query()->with('teacher')->orderBy('teacher', 'asc')
            ->orderBy('weekday', 'asc')->orderBy('hour', 'asc')
            ->with('student')->where('weekday', '=', $request->weekday)->paginate(60);


        foreach ($schedule as $item) {
            $item->teacherName = $item->teacher()->first()->name;
            $item->studentName = $item->student()->first()->name;
        }

        return Response::json($schedule, 200);
    }

    /**
     * Display a listing of the resource filtered by weekday and search key.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function weekdaySearch(Request $request)
    {
        $schedule = Schedule::query()
            ->where('weekday', '=', "%{$request->weekday}%")
            ->orWhere('weekday', 'LIKE', "%{$request->search}%")
            ->orWhereHas('teacher', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%");
            })
            ->orWhereHas('student', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%");
            })
            ->orWhere('hour', 'LIKE',"%{$request->search}%")->paginate(60);

        foreach ($schedule as $item) {
            $item->teacherName = $item->teacher()->first()->name;
            $item->studentName = $item->student()->first()->name;
        }

        return Response::json($schedule, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->teacher = $request->teacher;
        $schedule->student = $request->student;
        $schedule->weekday = $request->weekday;
        $schedule->hour = $request->hour;

        if (!$schedule->save()) {
            return Response::make('error on create', 400);
        }

        return Response::json($schedule, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Schedule $schedule)
    {
        return Response::json($schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Schedule $schedule)
    {
        $schedule->teacher = $request->teacher;
        $schedule->student = $request->student;
        $schedule->weekday = $request->weekday;
        $schedule->hour = $request->hour;

        if (!$schedule->save()) {
            return Response::make('error on update', 400);
        }

        return Response::json($schedule, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Schedule $schedule
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Schedule $schedule)
    {
        if (!$schedule->delete()) {
            return Response::make('error on delete', 400);
        }

        return Response::make('deleted', 200);
    }
}
