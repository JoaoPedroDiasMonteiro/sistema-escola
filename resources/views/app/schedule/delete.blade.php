@extends('app._template')

@section('content')
    Deleting...
    <form class="d-none" id="deleteForm" action="{{url('schedule/' . $schedule)}}" method="post">
        @csrf
        @method('delete')
    </form>
    @endsection

@section('scripts')
    <script>
        const r = confirm("Deleting schedule#" + {{$schedule}} + "... Are you sure?");
        if (r) {
            $('#deleteForm').submit();
        } else {
            window.close();
        }

    </script>
@endsection


