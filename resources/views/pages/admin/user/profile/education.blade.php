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
        <li><a href="/profile/{{$data->id}}/availabilities">Availabilities</a></li>
        <li><a href="/profile/{{$data->id}}/certifications">Certifications</a></li>
        <li class="active"><a href="">Education</a></li>
        <li><a href="/profile/{{$data->id}}/work_experience">Work Experience</a></li>
        <li><a href="/profile/{{$data->id}}/documents">Documents</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            @if($education)
                @section('table_headers')
                    <tr>
                        <th>Institution</th>
                        <th>Degree</th>
                        <th>Graduation Date</th>
                        <th style="width:1%">Action</th>
                    </tr>
                @stop
                @section('table_rows')
                    @foreach($education as $part)
                        <tr>
                            <td>{{$part->institution}}</td>
                            <td>{{$part->description}}</td>
                            <td>{{$part->graduation_date}}</td>
                            <td>@include('template.table_button', array('button_link'=> URL::to('/profile/'.$data->id.'/education/'.$part->id.'/edit')))</td>
                        </tr>
                    @endforeach
                @stop
                @include('template.table')
            @endif
        </div>
    </div>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection