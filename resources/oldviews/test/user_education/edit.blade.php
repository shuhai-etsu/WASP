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
                    <h3><b>Update Educational Achievement</b></h3>
                    <br>
                </div>
            </div>

            {{ Form::model($data, array('route' => array('user_education.update', $data->id),
                                        'method' => 'PUT',
                                        'class' => 'form-horizontal',
                                        'role' => 'form')) }}

            <div class="form-group">
                {{  Form::hidden('user_id', $data->user_id) }}
                {{  Form::label('type_id', 'Degree Type:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-4">
                    {{ Form::select('type_id', $degree_types) }}
                </div>
            </div>

            <div class="form-group">

                {{  Form::label('Institution', 'Institution:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-8">
                    {{  Form::text('institution', null, array('class' => 'form-control',
                                                              'maxlength' => '255',
                                                              'id' => 'institution')) }}
                </div>
            </div>

            <div class="form-group">

                {{  Form::label('Graduation Date', 'Graduation Date:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-2">
                    {{  Form::text('graduation_date', null, array('class' => 'form-control',
                                                                  'maxlength' => '15',
                                                                  'id' => 'graduation_date')) }}
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