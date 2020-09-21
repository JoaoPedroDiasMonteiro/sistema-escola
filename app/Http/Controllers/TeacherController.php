<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('app.teacher.index')->with('uri', 'teacher');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('app.teacher.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        if (!$teacher->save()){
            echo "<script>alert('Error on create');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Teacher created');</script>";
        echo "<script>window.close();</script>";
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Teacher $teacher)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Teacher $teacher)
    {
        return view('app.teacher.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Teacher $teacher
     * @return bool
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->name = $request->name;

        if (!$teacher->save()) {
            echo "<script>alert('Error on update');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Teacher Updated');</script>";
        echo "<script>window.close();</script>";
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Teacher $teacher
     * @return bool
     * @throws \Exception
     */
    public function destroy(Teacher $teacher)
    {
        if (!$teacher->delete()) {
            echo "<script>alert('Error on delete');</script>";
            echo "<script>window.close();</script>";
            return false;
        }

        echo "<script>alert('Teacher Deleted');</script>";
        echo "<script>window.close();</script>";
        return true;
    }
}
