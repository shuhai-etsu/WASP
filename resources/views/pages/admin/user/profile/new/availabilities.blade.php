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
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            <div class="row create-form">
                {{ Form::model($data, array('id'=>'user_profile','route' => array('user_profile.store_availabilities', $data->id),
                                      'class' => 'form-horizontal',
                                      'role' => 'form',
                                      'method' => 'PATCH')) }}
                <div class="form-group row">
                    {{ Form::label('start', 'Start Time',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('time','start_time', null, array('class' => 'form-control'))  }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('end', 'End Time',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('time','end_time', null, array('class' => 'form-control'))  }}

                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('semester', 'Semester',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::select('semester', $semester, null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('weekday', 'Weekday',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::select('weekday', $weekdays, null, array('class' => 'form-control')) }}
                    </div>
                </div>
                <hr/>
                <div class="form-group padding-top-2">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                        <a class="btn btn-default" href="{{URL::to('profile/'.$data->id.'/availabilities')}}">Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection