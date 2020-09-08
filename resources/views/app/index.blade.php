@extends('app._template')

@php($rows = ['teacher', 'student', 'day', 'hour'])
@php($names = ['teacher.name', 'student.name', 'weekday', 'hour'])

@section('content')
    <vc_schedule></vc_schedule>
@endsection
