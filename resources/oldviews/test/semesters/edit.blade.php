@extends('layouts.wasp')

@section('content')
    <div class="row">
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

        <h3>Edit Classroom</h3>

            {{ Form::model($data, array('route' => array('semester.update', $data->id), 'method' => 'PUT')) }}
            <div class="form-group">
                {{  Form::label('abbreviation', 'Abbreviation: ')  }}
                {{  Form::text('abbreviation', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{ Form::hidden('id', $data->id) }}
                {{  Form::label('description', 'Description: ')  }}
                {{  Form::text('description', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::label('start_date', 'Start Date: ')  }}
                {{  Form::text('start_date', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::label('end_date', 'End Date: ')  }}
                {{  Form::text('end_date', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::label('comment', 'Comment: ')  }}
                {{  Form::text('comment', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
            </div>

            {{  Form::close()  }}
    </div>
@stop