@extends('app._template')

@php($rows = ['teacher', 'student', 'day', 'hour'])
@php($names = ['teacher.name', 'student.name', 'weekday', 'hour'])

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1>Schedule</h1>
        </div>

        <div class="pt-2 pb-2">
            <a class="btn btn-outline-primary" href="{{route('schedule.create')}}" target="_blank">+ Add New Schedule</a>
        </div>
    </div>
    <vc_schedule></vc_schedule>
@endsection
