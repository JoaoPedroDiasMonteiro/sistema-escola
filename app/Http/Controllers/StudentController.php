<?php

namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
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

    public function all()
    {
        $student = Student::query()->orderBy('name', 'asc')
            ->with('schedule')
            ->get();

        foreach ($student as $item) {
            $item->studentSchedules = $item->schedule()->get()->count();
        }

        return Response::json($student, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('app.student.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        if (!$student->save()){
            echo "<script>alert('Error on create');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Student created');</script>";
        echo "<script>window.close();</script>";
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Student $student)
    {
        return Response::json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Student $student)
    {
        return view('app.student.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return bool
     */
    public function update(Request $request, Student $student)
    {
        $student->name = $request->name;

        if (!$student->save()) {
            echo "<script>alert('Error on update');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Student Updated');</script>";
        echo "<script>window.close();</script>";
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student $student
     * @return bool
     * @throws \Exception
     */
    public function destroy(Student $student)
    {
        if (!$student->delete()) {
            echo "<script>alert('Error on delete');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Student Deleted');</script>";
        echo "<script>window.close();</script>";
        return true;
    }
}
