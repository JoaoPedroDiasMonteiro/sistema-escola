@extends('app._template')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1>New Schedule</h1>
        </div>
        <div class="row justify-content-center">
            <form action="{{route('schedule.store')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputSelectTeacher">Select a Teacher</label>
                        <select class="form-control" id="inputSelectTeacher" name="teacher">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ml-3">
                        <label for="inputSelectStudent">Select a Student</label>
                        <select class="form-control" id="inputSelectStudent" name="student">
                            @foreach($students as $student)
                                <option value="{{$student->id}}">{{$student->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="inputSelectWeekDay">Select a Weekday</label>
                        <select class="form-control" id="inputSelectWeekDay" name="weekday">
                            <option>Sunday</option>
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                        </select>
                    </div>

                    <div class="form-group ml-3">
                        <label for="inputTime">Select an hour</label>
                        <br>
                        <input class="form-control" type="time" id="inputTime" name="hour">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
