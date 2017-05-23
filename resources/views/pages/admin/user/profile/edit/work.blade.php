@extends('template.layout_sidebar')
@section('title')
    @if($data)
        {{$data->first_name . ' ' . $data->last_name}}
    @endif
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    @if (count($errors) > 0)
        <div class="row">
            <div class="form-group col-sm-10">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <ul class="nav nav-tabs">
        <li><a href="/profile/{{$data->id}}/info">Personal Information</a></li>
        <li><a href="/profile/{{$data->id}}/emergency_contacts">Emergency Contact</a></li>
        <li><a href="/profile/{{$data->id}}/availabilities">Availabilities</a></li>
        <li><a href="/profile/{{$data->id}}/certifications">Certifications</a></li>
        <li><a href="/profile/{{$data->id}}/education">Education</a></li>
        <li class="active"><a href="">Work Experience</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            <div class="row create-form">
                {{ Form::model($data, array('id'=>'user_profile','route' => array('user_profile.update_work_experience', $data->id, $work->id),
                                      'class' => 'form-horizontal',
                                      'role' => 'form',
                                      'method' => 'PATCH')) }}
                <div class="form-group">
                    {{  Form::hidden('id', $data->id) }}
                </div>
            @if($work)
                <div class="form-group row">
                    {{ Form::label('company', 'Company Name',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('text','company', $work->company_name, array('class' => 'form-control'))  }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('date_left', 'Date Left',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('text','left', $work->date_left, array('class' => 'form-control',
                                                          'placeholder' =>'YYYY-MM-DD',
                                                          'maxlength' => '10'))  }}
                    </div>
                </div>
                    <div class="form-group row">
                        {{ Form::label('reason_left', 'Reason for leaving',['class'=>'col-xs-2 col-form-label'])  }}
                        <div class="col-sm-4">
                            {{ Form::input('text','reason', $work->reason_for_leaving, array('class' => 'form-control'))  }}
                        </div>
                    </div>
            @endif
                <div class="form-group padding-top-2">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                        <a class="btn btn-default" href="{{URL::to('profile/'.$data->id.'/work_experience')}}">Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection