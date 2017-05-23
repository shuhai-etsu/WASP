@extends('template.layout_no_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/employee_emergency_details.js') }}"></script>
@endpush

@section('title')
    Emergency Information
    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@section('page')
    @if (count($errors) > 0)
        <div class="row form-group col-sm-10">
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
        {{ Form::open(array('id'=>'emergency_contact','route' => array('emergency.update', $data->id),
                              'class' => 'form-horizontal',
                              'method' => 'PUT',
                              'role' => 'form')) }}
        <div class="form-group">
            {{  Form::hidden('user_id', Auth::id()) }}

        </div>
        <div class="form-group">
            {{  Form::label('first_name', 'First Name', array('class' => 'control-label col-sm-2')) }}
            <div class="col-xs-3">
                {{  Form::text('first_name',$data->first_name, array('class' => 'form-control',
                                                          'maxlength' => '10',
                                                          'id' => 'first_name'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('middle_name', 'Middle Name', array('class' => 'control-label col-sm-2')) }}
            <div class="col-xs-3">
                {{  Form::text('middle_name',$data->middle_name, array('class' => 'form-control',
                                                'id' => 'middle_name'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('last_name', 'Last Name', array('class' => 'control-label col-sm-2')) }}
            <div class="col-xs-3">
                {{  Form::text('last_name',$data->last_name, array('class' => 'form-control',
                                                'id' => 'last_name'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('relationship_id', 'Relation', array('class' => 'control-label col-sm-2')) }}
            <div class="col-xs-3">
                {{ Form::select('relationship_id', $relationships, $data->relationship_id, array('class' => 'form-control',
                                                                    'id'=>'relationship_id',
                                                                    )) }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('telephone_number', 'Telephone Number', array('class' => 'control-label col-sm-2')) }}
            <div class="col-xs-3">
                {{  Form::text('telephone_number',$data->telephone_number, array('class' => 'form-control',
                                                'id' => 'telephone_number'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('email', 'Email', array('class' => 'control-label col-sm-2')) }}
            <div class="col-xs-3">
                {{  Form::text('email',$data->email, array('class' => 'form-control',
                                                'id' => 'email'))  }}
            </div>
        </div>

        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                <a class="btn btn-default" href="{{URL::to('emergency')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.student_emergencyContact_view')
@stop

