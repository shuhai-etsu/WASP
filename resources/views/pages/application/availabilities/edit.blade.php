@extends('template.layout_no_sidebar')

@section('head')
    @push('css')
        <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />
    @endpush
    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/availabilities.js') }}"></script>
    @endpush
@endsection

@section('title')
    ETSU Child Study Center Student Worker Application - Availabilities
@endsection

@section('page')
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

    <div class="row student-application-form">
        {{ Form::model($availability, array( 'route' => array('user_availabilities.update', $availability->id),
                                             'role' => 'form',
                                             'method' => 'PATCH')) }}

        {{ Form::hidden('id', $availability->id) }}
        {{ Form::hidden('user_id', $availability->user_id) }}
        <div class="form-group row">
            {{ Form::label('semester_id', 'Semester',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-xs-3">
                {{ Form::select('semester_id', $semesters, null,['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('weekday_id', 'Weekday',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-xs-3">
                {{ Form::select('weekday_id', $weekdays, null ,['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('start_time', 'Start Time',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-xs-3">
                {{ Form::input('time','start_time', null, ['class'=>'timepicker']) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('end_time', 'End Time',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-xs-3">
                {{ Form::input('time','end_time', null, ['class'=>'timepicker']) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('comment', 'Comment',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-xs-3">
                {{ Form::text('comment', null, ['class'=>'form-control']) }}
            </div>
        </div>
        
        <div class="form-group row">
            <div class=" col-sm-offset-2 col-sm-10">
                {{  Form::submit('Save', array('class' => 'btn btn-primary'))  }}
                <a class="btn btn-danger" href="{{URL::to('user_availabilities/')}}">Cancel</a>
            </div>
        </div>

        {{  Form::close()  }}
    </div>
@stop