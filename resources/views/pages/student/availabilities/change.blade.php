@extends('template.layout_sidebar')

@section('title')
    Availabilities Exception Change Request
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @section('table_headers')
            <tr>
                <th class="no-sort">Select Exception</th>
                <th>Period</th>
                <th>Day</th>
                <td>Date</td>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        @stop
        @section('table_rows')
            @for($i=1;$i<4;$i++)
            <tr>
                <td><input type="checkbox"></td>
                <td>Fall 2017</td>
                <td>Monday</td>
                <td><?php
                    date_default_timezone_set("Pacific/Nauru");
                    echo date("m/d/Y");?></td>
                <td>1 pm</td>
                <td>4 pm</td>
            </tr>
            @endfor
        @stop
        @include('template.table')
    </div>
    <span class="btn btn-primary margin-left-2"
          style="position:relative;bottom: 34px;">Remove Exception</span>
    @include('pages.modal.user_help.student_availabilities_view')
@endsection