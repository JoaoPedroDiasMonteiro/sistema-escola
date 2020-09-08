@extends('app._template')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1>Edit #{{$schedule->id}}</h1>
        </div>
        <div class="row justify-content-center">
            <form action="{{url('api/schedule/edit/' . $schedule->id)}}" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputSelectTeacher">Select a Teacher</label>
                        <select class="form-control" id="inputSelectTeacher" name="teacher">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}"
                                        @if($teacher->id === $schedule->teacher) selected @endif>{{$teacher->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ml-3">
                        <label for="inputSelectStudent">Select a Student</label>
                        <select class="form-control" id="inputSelectStudent" name="student">
                            @foreach($students as $student)
                                <option value="{{$student->id}}"
                                        @if($student->id === $schedule->student) selected @endif>{{$student->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="inputSelectWeekDay">Select a Weekday</label>
                        <select class="form-control" id="inputSelectWeekDay" name="weekday">
                            <option @if($schedule->weekday === 'Sunday') selected @endif>Sunday</option>
                            <option @if($schedule->weekday === 'Monday') selected @endif>Monday</option>
                            <option @if($schedule->weekday === 'Tuesday') selected @endif>Tuesday</option>
                            <option @if($schedule->weekday === 'Wednesday') selected @endif>Wednesday</option>
                            <option @if($schedule->weekday === 'Thursday') selected @endif>Thursday</option>
                            <option @if($schedule->weekday === 'Friday') selected @endif>Friday</option>
                            <option @if($schedule->weekday === 'Saturday') selected @endif>Saturday</option>
                        </select>
                    </div>

                    <div class="form-group ml-3">
                        <label for="inputTime">Select a hour</label>
                        <br>
                        <input class="form-control" type="time" id="inputTime" value="{{$schedule->hour}}" name="hour">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
