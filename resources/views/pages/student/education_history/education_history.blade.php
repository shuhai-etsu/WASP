@extends('template.layout_sidebar')

@section('title')
    Education
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @if($education_history)
            @section('table_headers')
                <tr>
                    <th>Institution</th>
                    <th>Degree</th>
                    <th>Graduation Date</th>
                </tr>
            @stop

            @section('table_rows')
                @foreach($education_history as $part)
                    <tr>
                        <td>{{$part->institution}}</td>
                        <td>{{$part->description}}</td>
                        <td>{{$part->graduation_date}}</td>
                    </tr>
                @endforeach
            @stop
        @endif
    @include('template.table')
    </div>
@include('pages.modal.user_help.student_education_view')
@endsection