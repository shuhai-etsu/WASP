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
                    <h3><b>Update Philosophy</b></h3>
                    <br>
                </div>
            </div>

            {{ Form::model($data, array('route' => array('user_philosophies.update', $data->id),
                                        'method' => 'PUT',
                                        'class' => 'form-horizontal',
                                        'role' => 'form')) }}

            <div class="form-group">
                {{  Form::hidden('user_id', $data->user_id) }}
                {{  Form::label('type_id', 'Philosophy Type:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-6">
                    {{ Form::select('type_id', $philosophy_types) }}
                </div>
            </div>

            <div class="form-group">

                {{  Form::label('philosophy', 'Philosophy:', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-8">
                    {{  Form::textarea('philosophy', null, array('class' => 'form-control',
                                                                 'maxlength' => '65000',
                                                                 'rows' => '4',
                                                                 'cols' => '50',
                                                                 'id' => 'philosophy')) }}
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