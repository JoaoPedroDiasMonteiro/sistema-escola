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
        $schedule = $this->queryWithJoin()
            ->paginate(60);

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
        $schedule = $this->queryWithJoin()
            ->where(function ($query) use ($request) {
                $query->where('weekday', 'LIKE', "%{$request->search}%")
                    ->orWhere('hour', 'LIKE', "%{$request->search}%")
                    ->orWhere('T.name', 'LIKE', "%{$request->search}%")
                    ->orWhere('S.name', 'LIKE', "%{$request->search}%");
            })->paginate(60);

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
        $schedule = $this->queryWithJoin()
            ->where('weekday', '=', $request->weekday)
            ->paginate(60);

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
        $schedule = $this->queryWithJoin()
            ->where('weekday', 'LIKE', "%{$request->weekday}%")
            ->where(function ($query) use ($request) {
                $query->where('hour', 'LIKE', "%{$request->search}%")
                    ->orWhere('T.name', 'LIKE', "%{$request->search}%")
                    ->orWhere('S.name', 'LIKE', "%{$request->search}%");
            })->paginate(60);

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

    /**
     * Return schedule query builder with relationships joins
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function queryWithJoin()
    {
        return Schedule::query()
            ->select('schedules.*', 'T.name as teacherName', 'S.name as studentName')
            ->join('teachers as T', 'T.id', '=', 'teacher')
            ->join('students as S', 'S.id', '=', 'student')
            ->orderBy('teacherName', 'asc')
            ->orderBy('weekday', 'asc')
            ->orderBy('hour', 'asc');
    }
}
