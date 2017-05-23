@extends('template.layout_sidebar')

@section('title')
    Work Experience
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>

@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @if($work_experience)
        @section('table_headers')
                <tr>
                    <th>Company</th>
                    <th>Date Left</th>
                    <th>Reason for Leaving</th>
                </tr>
        @stop

        @section('table_rows')
            @foreach($work_experience as $part)
                <tr>
                    <td>{{$part->company_name}}</td>
                    <td>{{$part->date_left}}</td>
                    <td>{{$part->reason_for_leaving}}</td>
                </tr>
            @endforeach
        @stop
        @endif
        @include('template.table')
    </div>
@include('pages.modal.user_help.student_workExperience_view')
@endsection