@extends('app._template')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1>Teachers</h1>
        </div>

        <div>
            <a class="btn btn-outline-primary" href="{{url('/teachers/new')}}" target="_blank">+ Add New Teacher</a>
        </div>

        <div class="row">
            <vc_table
                :prop_table_rows="['name', 'students']"
                prop_url="api/teacher"
                :prop_table_names="['name', 'teacherSchedules']"
                prop_action_url="teacher"
            ></vc_table>
        </div>
    </div>
@endsection
