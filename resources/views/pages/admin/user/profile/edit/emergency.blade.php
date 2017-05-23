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
        <li class="active"><a href="">Emergency Contact</a></li>
        <li><a href="/profile/{{$data->id}}/availabilities">Availabilities</a></li>
        <li><a href="/profile/{{$data->id}}/certifications">Certifications</a></li>
        <li><a href="/profile/{{$data->id}}/education">Education</a></li>
        <li><a href="/profile/{{$data->id}}/work_experience">Work Experience</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            <div class="row create-form">
                {{ Form::model($data, array('id'=>'user_profile','route' => array('user_profile.update_emergency_contact', $data->id, $contact->id),
                                      'class' => 'form-horizontal',
                                      'role' => 'form',
                                      'method' => 'PATCH')) }}
                <div class="form-group">
                    {{  Form::hidden('id', $data->id) }}
                </div>
            @if($contact)
                <div class="form-group row">
                    {{ Form::label('first_name', 'First Name',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('text','first_name', $contact->first_name, array('class' => 'form-control'))  }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('middle_name', 'Middle Name',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('text','middle_name', $contact->middle_name, array('class' => 'form-control'))  }}
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('last_name', 'Last Name',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('text','last_name', $contact->last_name, array('class' => 'form-control'))  }}
                    </div>
                </div>
                {{--<div class="form-group row">--}}
                    {{--{{ Form::label('desc', 'Suffix',['class'=>'col-xs-2 col-form-label'])  }}--}}
                    {{--<div class="col-sm-4">--}}
                        {{--{{ Form::select('suffix', $suffix, $contact->suffix_id -1, array('id' => 'degrees', 'class' => 'form-control')) }}--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group row">
                    {{ Form::label('desc', 'Relationship',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::select('relationship', $relationship, $contact->relationship_id -1, array('id' => 'degrees', 'class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group row">
                        {{ Form::label('telephone', 'Telephone Number',['class'=>'col-xs-2 col-form-label'])  }}
                        <div class="col-sm-4">
                            {{ Form::input('text','telephone', $contact->telephone_number, array('class' => 'form-control'))  }}
                        </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('email', 'Email',['class'=>'col-xs-2 col-form-label'])  }}
                    <div class="col-sm-4">
                        {{ Form::input('text','email', $contact->email, array('class' => 'form-control'))  }}
                    </div>
                </div>

            @endif
                <div class="form-group padding-top-2">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                        <a class="btn btn-default" href="{{URL::to('profile/'.$data->id.'/emergency_contacts')}}">Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection