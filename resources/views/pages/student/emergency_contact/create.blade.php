@extends('template.layout_sidebar')


@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/student_emergency_info.js') }}"></script>
@endpush

@section('title')

    Add Emergency Contact

    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>

@endsection
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
        {{ Form::open(array('id'=>'emergency_contact','route' => 'studentHomeController.store_emergency_contact',
                              'class' => 'form-horizontal',
                               'method' => 'PATCH',
                              'role' => 'form')) }}
        <div class="form-group">
            {{  Form::hidden('user_id', Auth::id()) }}

        </div>
        <div class="form-group">
            {{  Form::label('first_name', 'First Name', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('first_name',null, array('class' => 'form-control',
                                                          'maxlength' => '10',
                                                          'id' => 'first_name'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('middle_name', 'Middle Name', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('middle_name',null, array('class' => 'form-control',
                                                'id' => 'middle_name'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('last_name', 'Last Name', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('last_name',null, array('class' => 'form-control',
                                                'id' => 'last_name'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('relationship', 'Relation', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{ Form::select('relationship_id', $relationships, null, array('class' => 'form-control',
                                                                    'id'=>'relations',
                                                                    )) }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('telephone_number', 'Telephone Number', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('telephone_number',null, array('class' => 'form-control',
                                                'id' => 'telephone_number'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('email', 'Email', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('email',null, array('class' => 'form-control',
                                                'id' => 'email'))  }}
            </div>
        </div>

        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                <a class="btn btn-default" href="{{URL::to('studentEmergencyContact')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.student_emergencyContact_view')
@stop
