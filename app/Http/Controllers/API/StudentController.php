<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $student = Student::query()->orderBy('name', 'asc')
            ->with('schedule')
            ->paginate(100);

        foreach ($student as $item) {
            $item->studentSchedules = $item->schedule()->get()->count();
        }

        return Response::json($student, 200);
    }

    /**
     * Display a listing of the resource filtered by search key.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $student = Student::query()
            ->where('name', 'LIKE', "%{$request->search}%")
            ->paginate(60);

        foreach ($student as $item) {
            $item->studentSchedules = $item->schedule()->get()->count();
        }

        return Response::json($student, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse | \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        if (!$student->save()) {
            return Response::make('error on create', 400);
        }

        return Response::json($student, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Student $student)
    {
        return Response::json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Student $student)
    {
        $student->name = $request->name;

        if (!$student->save()) {
            return Response::make('error on update', 400);
        }

        return Response::json($student, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Student $student)
    {
        if (!$student->delete()) {
            return Response::make('error on delete', 400);
        }

        return Response::make('deleted', 200);
    }
}
