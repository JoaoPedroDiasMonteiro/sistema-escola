@extends('app._template')


@section('content')
    <div style="width: 100%;
                height: 100vh;
                background-color: var(--white);
                display: flex;
                position: absolute;
                top: 0;
                left: 0;
                align-items: center;">
        <div class="container text-white text-center">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('teacher.index')}}"><h2>Teacher</h2></a>
                </div>

                <div class="col-12">
                    <a href="{{route('schedule.index')}}"><h2>Secretary</h2></a>
                </div>

                <div class="col-12">
                    <a href=""><h2>Admin</h2></a>
                </div>
            </div>
        </div>
    </div>
@endsection
