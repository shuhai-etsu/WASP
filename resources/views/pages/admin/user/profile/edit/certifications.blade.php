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
        <li class="active"><a href="">Certifications</a></li>
        <li><a href="/profile/{{$data->id}}/education">Education</a></li>
        <li><a href="/profile/{{$data->id}}/work_experience">Work Experience</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active padding-top-2">
            {{--
            ***IMPORTANT*** Any select form's default selection is decreased by one since the form begins at zero and
            database IDs begin at one.
            --}}

            <div class="row create-form">
                {{ Form::model($data, array('id'=>'user_profile','route' => array('user_profile.update_certifications', $data->id, $certification->id),
                                      'class' => 'form-horizontal',
                                      'role' => 'form',
                                      'method' => 'PATCH')) }}
                <div class="form-group">
                    {{  Form::hidden('id', $data->id) }}
                </div>
                @if($certification)
                        <div class="form-group row">
                            {{ Form::label('certification', 'Certification',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::select('cert', $cert_list, $certification->certification_id-1, array('class' => 'form-control')) }}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('date_cert', 'Date Certified',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::input('text','certified', $certification->date_certified, array('class' => 'form-control',
                                                                  'placeholder' =>'YYYY-MM-DD',
                                                                  'maxlength' => '10'))  }}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('expr_date', 'Expiration Date' ,['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::input('text','expiration', $certification->expiration_date, array('class' => 'form-control',
                                                                  'placeholder' =>'YYYY-MM-DD',
                                                                  'maxlength' => '10'))  }}
                            </div>
                        </div>
                        <hr/>
                @endif
                <div class="form-group padding-top-2">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                        <a class="btn btn-default" href="{{URL::to('profile/'.$data->id.'/certifications')}}">Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{--@include('pages.modal.user_help.user_search')--}}
@endsection