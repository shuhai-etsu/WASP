@extends('template.layout_sidebar')

@section('title')
    Schedule
    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @section('table_headers')
            <tr>
                <th>Abbreviation</th>
                <th>Description</th>
                <th>Semester</th>
                <th>Classroom</th>
                <th>Comment</th>
                <th class="no-sort" style="width: 30px;">Action</th>
            </tr>
        @stop

        @section('table_rows')
            @foreach($data as $row)
                <tr>
                    <td>{{$row->abbreviation}}</td>
                    <td>{{$row->description}}</td>
                    <td>{{$semesters[$row->semester_id-1]}}</td>
                    <td>{{$classrooms[$row->classroom_id-1]}}</td>
                    <td>{{$row->comment}}</td>
                    <td style="display:inline-block;white-space:nowrap;">
                        @include('template.table_button', array('button_link'=> URL::to('schedules/'.$row->id.'/edit')))
                    </td>
                </tr>
            @endforeach
        @stop
        
        @include('template.table')
    </div>

    <div class="row">
        <a class="btn btn-primary pull-left" href="{{URL::to('schedules/create')}}" style="position:relative;bottom: 34px;">New Schedule</a>
    </div>
    <br/>
    @include('pages.modal.user_help.schedule_index')
@stop