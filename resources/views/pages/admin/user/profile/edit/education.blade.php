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
        <li class="active"><a href="">Education</a></li>
        <li><a href="/profile/{{$data->id}}/work_experience">Work Experience</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            <div class="row create-form">
                {{ Form::model($data, array('id'=>'user_profile','route' => array('user_profile.update_education', $data->id, $education->id),
                                      'class' => 'form-horizontal',
                                      'role' => 'form',
                                      'method' => 'PATCH')) }}
                <div class="form-group">
                    {{  Form::hidden('id', $data->id) }}
                </div>
            @if($education)
                <div class="form-group row">
                        {{ Form::label('company', 'Institution',['class'=>'col-xs-2 col-form-label'])  }}
                        <div class="col-sm-4">
                            {{ Form::input('text','institution', $education->institution, array('class' => 'form-control'))  }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('desc', 'Degree',['class'=>'col-xs-2 col-form-label'])  }}
                        <div class="col-sm-4">
                            {{ Form::select('degree', $degrees, $education->type_id -1, array('id' => 'degrees', 'class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('grad_date', 'Graduation date',['class'=>'col-xs-2 col-form-label'])  }}
                        <div class="col-sm-4">
                            {{ Form::input('text','graduation', $education->graduation_date, array('class' => 'form-control',
                                                              'placeholder' =>'YYYY-MM-DD',
                                                              'maxlength' => '10'))  }}
                        </div>
                    </div>
                @endif
                <div class="form-group padding-top-2">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                        <a class="btn btn-default" href="{{URL::to('profile/'.$data->id.'/education')}}">Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection