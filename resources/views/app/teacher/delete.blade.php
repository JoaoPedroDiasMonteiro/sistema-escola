@extends('app._template')

@section('content')
    Deleting...
    <form class="d-none" id="deleteForm" action="{{route('teacher.destroy', $teacher)}}" method="post">
        @csrf
        @method('delete')
    </form>
@endsection

@section('scripts')
    <script>
        const r = confirm("Deleting teacher#" + {{$teacher}} +"... Are you sure?");
        if (r) {
            $('#deleteForm').submit();
        } else {
            window.close();
        }

    </script>
@endsection


