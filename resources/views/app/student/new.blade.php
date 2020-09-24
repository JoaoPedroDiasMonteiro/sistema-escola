@extends('app._template')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1>New Student</h1>
        </div>
        <div class="row justify-content-center">
            <form action="{{route('student.store')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputSelectTeacher">Name</label>
                        <input type="text" name="name">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
