@extends('template.layout_sidebar')

@section('title')

    Schedule

    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>

@endsection
@section('page')
    <div class="margin-left-2 list-table">
        @if($schedule)
        @section('table_headers')
            <tr>
                <th>Semester</th>
                <th>Class</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        @stop

        @section('table_rows')
            @foreach($schedule as $part)
                <tr>
                    <td>{{$part->semester}}</td>
                    <td>{{$part->classroom}}</td>
                    <td>{{$part->day}}</td>
                    <td> {{$part->start_time}}</td>
                    <td>{{$part->end_time}}</td>
                </tr>
            @endforeach
        @stop
        @endif
        @include('template.table')
    </div>
    @include('pages.modal.user_help.student_studentSchedule')
@stop