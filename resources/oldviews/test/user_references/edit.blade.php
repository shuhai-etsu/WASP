@extends('layouts.wasp')

@section('content')
    @if (count($errors) > 0)
        <div class="row">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="form-group">
            <div class="col-sm-12 control-label">
                <br>
                <h3><b>Update Reference</b></h3>
                <br>
            </div>
        </div>

        {{ Form::model($data, array('route' => array('user_references.update', $data->id),
                                    'method' => 'PUT',
                                    'class' => 'form-horizontal',
                                    'role' => 'form')) }}


        <div class="form-group">
            {{  Form::hidden('user_id', $data->user_id) }}
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
            {{  Form::label('telephone', 'Telephone:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-4">
                {{  Form::text('telephone_number', null, array('class' => 'form-control',
                                                               'maxlength' => '15',
                                                               'id' => 'telephone_number'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('type', 'Telephone Type:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-4">
                {{ Form::select('type_id', $telephone_types) }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('comment', 'Comment:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-8">
                {{  Form::text('comment', null, array('class' => 'form-control',
                                                      'maxlength' => '255',
                                                      'id' => 'comment'))  }}
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