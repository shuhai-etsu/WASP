@extends('template.layout_sidebar')
@section('title')
    @if($data)
        {{$data->first_name . ' ' . $data->last_name}}
    @endif
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    @if (count($errors) > 0)
        <div class="form-group col-sm-10">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <ul class="nav nav-tabs">
        <li><a href="/profile/{{$data->id}}/info">Personal Information</a></li>
        <li><a href="/profile/{{$data->id}}/emergency_contacts">Emergency Contact</a></li>
        <li class="active"><a href="">Availabilities</a></li>
        <li><a href="/profile/{{$data->id}}/certifications">Certifications</a></li>
        <li><a href="/profile/{{$data->id}}/education">Education</a></li>
        <li><a href="/profile/{{$data->id}}/work_experience">Work Experience</a></li>
        <li><a href="/profile/{{$data->id}}/documents">Documents</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            @if($availabilities)
                @section('table_headers')
                    <tr>
                        <th>Semester</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th style="width:1%">Action</th>
                    </tr>
                @stop
                @section('table_rows')
                @foreach($availabilities as $part)
                    <tr>
                        <td>{{$part->semester_desc}}</td>
                        <td>{{$part->week_desc}}</td>
                        <td>{{$part->start_time}}</td>
                        <td>{{$part->end_time}}</td>
                        <td>@include('template.table_button', array('button_link'=> URL::to('/profile/'.$data->id.'/availabilities/'.$part->id.'/edit')))</td>
                    </tr>
                @endforeach
                @stop
                @include('template.table')
            @endif
        </div>
    </div>
    <a class="btn btn-primary pull-left" href="{{URL::to('profile/'.$data->id.'/availabilities/new')}}" style="position:relative;bottom: 34px;">New Availability</a>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection