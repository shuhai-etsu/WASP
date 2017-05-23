@extends('template.layout_sidebar')

@section('title')
    Availabilities Exception
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @section('table_headers')

            <tr>
                <th>Period</th>
                <th>Day</th>
                <td>Date</td>
                <th>Start Time</th>
                <th>End Time</th>
                <th class="no-sort" style="width: 30px;">Action</th>
            </tr>
        @stop
        @section('table_rows')
            @for($i=1;$i<4;$i++)
            <tr>
                <td>Fall 2017</td>
                <td>Monday</td>
                <td><?php
                    date_default_timezone_set("Pacific/Nauru");
                    echo date("m/d/Y");?></td>
                <td>1 pm</td>
                <td>4 pm</td>
                <td>@include('template.table_button')</td>
            </tr>
                @endfor
        @stop
        @include('template.table')
    </div>
    <span class="btn btn-primary margin-left-2 create-btn" style="position:relative;bottom: 34px;">New Availabilities Exception</span>
    @include('pages.modal.user_help.student_availabilities_exception')



    {{---Add Exception on Student Availabilities --}}

    <div class="row create-form hidden">
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Day</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" placeholder="For Example: Day">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="abbr">Date</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="abbr" placeholder="For Example: Date">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="abbr">Start Time</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="abbr" placeholder="For Example: Start Time">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="abbr">End Time</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="abbr" placeholder="For Example: End Time">
                </div>
            </div>
            <div class="form-group padding-top-2">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" style="position: relative; align-items: center">Save
                    </button>
                    <button type="submit" class="btn btn-default" style="position: relative;align-items: left">Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    @include('pages.modal.user_help.student_availabilities_view')
@stop