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
        <li class="active"><a href="">Certifications</a></li>
        <li><a href="/profile/{{$data->id}}/education">Education</a></li>
        <li><a href="/profile/{{$data->id}}/work_experience">Work Experience</a></li>
        <li><a href="/profile/{{$data->id}}/documents">Documents</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            @if($certifications)
                @section('table_headers')
                    <tr>
                        <th>Abbreviation</th>
                        <th>Description</th>
                        <th>Date Certified</th>
                        <th>Expiration Date</th>
                        <th style="width:1%">Action</th>
                    </tr>
                @stop
                @section('table_rows')
                @foreach($certifications as $part)
                    <tr>
                        <td>{{$part->abbreviation}}</td>
                        <td>{{$part->description}}</td>
                        <td>{{$part->date_certified}}</td>
                        <td>{{$part->expiration_date ? $part->expiration_date : 'N/A'}}</td>
                        <td>@include('template.table_button', array('button_link'=> URL::to('/profile/'.$data->id.'/certifications/'.$part->id.'/edit')))</td>
                    </tr>
                @endforeach
                @stop
                @include('template.table')
            @endif
        </div>
    </div>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection