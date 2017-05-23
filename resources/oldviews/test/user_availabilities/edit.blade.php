@extends('layouts.wasp')

@section('content')
    <div class="row">
        <div class="form-group">
            <h3> Edit Availability</h3>
        </div>

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

        {{ Form::model($data, array('route' => array('user_availabilities.update', $data->id), 'method' => 'PUT')) }}
        <div class="form-group">
            {{ Form::label('semester_id', 'Semester: ')  }}
            {{ Form::select('semester_id', $semesters) }}
        </div>
        <div class="form-group">
            {{ Form::label('weekday_id', 'Weekday: ')  }}
            {{ Form::select('weekday_id', $weekdays) }}
        </div>
        <div class="form-group">
            {{  Form::label('start_time', 'Start Time: ')  }}
            {{  Form::text('start_time', null, array('class' => 'form-control'))  }}
        </div>
        <div class="form-group">
            {{  Form::label('end_time', 'End Time: ')  }}
            {{  Form::text('end_time', null, array('class' => 'form-control'))  }}
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