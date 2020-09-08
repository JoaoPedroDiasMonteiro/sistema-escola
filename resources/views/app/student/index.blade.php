@extends('app._template')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1>Students</h1>
        </div>

        <div>
            <a class="btn btn-outline-primary" href="{{url('/students/new')}}" target="_blank">+ Add New Student</a>
        </div>

        <div class="row">
            <vc_table
                :prop_table_rows="['name', 'registered in']"
                prop_url="api/student"
                :prop_table_names="['name', 'studentSchedules']"
                prop_action_url="student"
            ></vc_table>
        </div>
    </div>
@endsection
