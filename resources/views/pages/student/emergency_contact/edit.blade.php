@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/student_emergency_info.js') }}"></script>
@endpush

@section('title')
    Edit Emergency Contact
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

            <div class="row create-form">
                {{ Form::model($data, array('id'=>'emergency_contact','route' => array('studentEmergencyContact.update_emergency_contact', $contacts->id),
                                      'class' => 'form-horizontal',
                                      'role' => 'form',
                                      'method' => 'PATCH')) }}
                <div class="form-group">
                    {{  Form::hidden('id', $data->id) }}
                </div>
                @if($contacts)
                    {{--@foreach($contacts as $part)--}}
                        <div class="form-group row">
                            {{ Form::label('first_name', 'First Name',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::input('text','first_name', $contacts->first_name, array('class' => 'form-control','id' => 'first_name'))  }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('middle_name', 'Middle Name',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::input('text','middle_name', $contacts->middle_name, array('class' => 'form-control','id' => 'middle_name'))  }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('last_name', 'Last Name',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::input('text','last_name', $contacts->last_name, array('class' => 'form-control','id' => 'last_name'))  }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('desc', 'Relationship',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::select('relationship', $relationship, $contacts->relationship_id, array('id' => 'relations', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('telephone', 'Telephone Number',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::input('text','telephone', $contacts->telephone_number, array('class' => 'form-control','id' => 'telephone_number'))  }}
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('email', 'Email',['class'=>'col-xs-2 col-form-label'])  }}
                            <div class="col-sm-4">
                                {{ Form::text('email', $contacts->email, array('class' => 'form-control','id'=>'email'))  }}
                            </div>
                        </div>
                        <hr/>
                    {{--@endforeach--}}
                @endif
                <div class="form-group padding-top-2">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                        <a class="btn btn-default" href="{{URL::to('studentEmergencyContact')}}">Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    @include('pages.modal.user_help.student_emergencyContact_view')
@endsection