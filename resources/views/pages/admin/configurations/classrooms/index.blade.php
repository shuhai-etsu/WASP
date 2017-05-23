@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
@endpush
@section('title')

    Classroom

    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>

@endsection
@section('page')
    <div class="margin-left-2 list-table">

        @section('table_headers')
            <tr>
                <th>Name</th>
                <th style="width:30px;">Abbreviation</th>
                <th style="width:150px;">Min Students</th>
                <th style="width:150px;">Max Students</th>
                {{--<th>Age Group</th>--}}
                <th>Comments</th>
                <th class="no-sort" style="width: 30px;">Action</th>
            </tr>
        @stop
        @section('table_rows')
            @foreach($data as $row)
                <tr>
                    <td>{{$row->description}}</td>
                    <td>{{$row->abbreviation}}</td>
                    <td>{{$row->minimum_students}}</td>
                    <td>{{$row->maximum_students}}</td>
                    <td>{{$row->comment}}</td>
                    <td>
                        @include('template.table_button', array('button_link'=> URL::to('classrooms/'.$row->id.'/edit')))
                    </td>
                </tr>
            @endforeach
        @stop
        @include('template.table')
    </div>

    <div class="row">
        <a id='classroom_id' class="btn btn-primary pull-left" href="{{URL::to('classrooms/create')}}" style="position:relative;bottom: 34px;">New Classroom</a>
    </div>
    <br/>
    @include('pages.modal.user_help.configurations')

@stop