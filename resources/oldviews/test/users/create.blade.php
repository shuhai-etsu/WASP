@extends('layouts.wasp')

@section('content')
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
    {{  Form::open(['route' => 'users.store',
                                 'class' => 'form-horizontal',
                                 'role' => 'form']) }}

        <div class="form-group">
            <div class="col-sm-12 control-label">
                <h3><b>Add User</b></h3>
            </div>
        </div>

            <div class="form-group">
                {{  Form::label('first_name', 'First Name:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{  Form::text('first_name', null, array('class' => 'form-control',
                                                                          'maxlength' => '25',
                                                                          'id' => 'first_name'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('middle_name', 'Middle Name:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{  Form::text('middle_name', null, array('class' => 'form-control',
                                                                         'maxlength' => '25',
                                                                         'id' => 'middle_name'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('last_name', 'Last Name:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{  Form::text('last_name', null, array('class' => 'form-control',
                                                                       'maxlength' => '25',
                                                                       'id' => 'last_name'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('suffix_id', 'Suffix:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{  Form::select('suffix_id', $suffixes, null, ['id' => 'suffix_id', 'class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('gender_id', 'Gender:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{  Form::select('gender_id', $genders, null, ['id' => 'gender_id',
                                                               'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('email', 'Email Address:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-6">
                {{  Form::text('email', null, array('class' => 'form-control',
                                                               'maxlength' => '100',
                                                               'id' => 'email'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('password', 'Password:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-4">
                {{  Form::text('password', null, array('class' => 'form-control',
                                                                  'maxlength' => '25',
                                                                  'id' => 'password'))  }}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
            </div>
        </div>


        {{  Form::close()  }}
    </div>
@stop

