@extends('app._template')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1>Edit #{{$student->id}}</h1>
        </div>
        <div class="row justify-content-center">
            <form action="{{url('api/student/edit/' . $student->id)}}" method="post">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group">
                        <label for="inputSelectTeacher">Name</label>
                        <input type="text" value="{{$student->name}}" name="name">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
