@extends('template.layout_sidebar')

@section('title')
    Availabilities
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @if($availabilities)
        @section('table_headers')
            <tr>
                <th>Semester</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        @stop

        @section('table_rows')
            @foreach($availabilities as $part)
                <tr>
                    <td>{{$part->semester_desc}}</td>
                    <td>{{$part->week_desc}}</td>
                    <td>{{date('h:i A',strtotime($part->start_time))}}</td>
                    <td>{{date('h:i A',strtotime($part->end_time))}}</td>
                </tr>
            @endforeach
        @stop
        @include('template.table')
        @endif
    </div>
    <div class="row">
        <a id="availabilities_id" class="btn btn-primary pull-left" href="{{URL::to('/studentAvailabilities/create')}}" style="position:relative;bottom: 34px;">Add Availabilities</a>
    </div>
    @include('pages.modal.user_help.student_availabilities_view')
@stop