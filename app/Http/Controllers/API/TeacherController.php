<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $teacher = Teacher::query()->orderBy('name', 'asc')
            ->with('schedule')
            ->paginate(100);

        foreach ($teacher as $item) {
            $item->studentSchedules = $item->schedule()->get()->count();
        }

        return Response::json($teacher, 200);
    }

    /**
     * Display a listing of the resource filtered by search key.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $teacher = Teacher::query()
            ->where('name', 'LIKE', "%{$request->search}%")
            ->paginate(60);

        foreach ($teacher as $item) {
            $item->studentSchedules = $item->schedule()->get()->count();
        }

        return Response::json($teacher, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        if (!$teacher->save()) {
            return Response::make('error on create', 400);
        }

        return Response::json($teacher, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Teacher $teacher)
    {
        return Response::json($teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->name = $request->name;

        if (!$teacher->save()) {
            return Response::make('error on update', 400);
        }

        return Response::json($teacher, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Teacher $teacher)
    {
        if (!$teacher->delete()) {
            return Response::make('error on delete', 400);
        }

        return Response::make('deleted', 200);
    }
}
