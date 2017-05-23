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

            {{ Form::model($data, array('route' => array('classrooms.update', $data->id), 'method' => 'PUT')) }}
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
                {{  Form::label('minimum_students', 'Min Students: ')  }}
                {{  Form::text('minimum_students', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{  Form::label('maximum_students', 'Max Students: ')  }}
                {{  Form::text('maximum_students', null, array('class' => 'form-control'))  }}
            </div>
            {{--
            <div class="form-group">
                {{  Form::label('room', 'Room #: ')  }}
                {{  Form::text('room', null, array('class' => 'form-control'))  }}
            </div>
            <div class="form-group">
                {{ Form::label('building_id', 'Building: ')  }}
                {{ Form::select('building_id', $buildings, array($data->building_id), array('id' => 'buildingID')) }}
            </div>
            --}}
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