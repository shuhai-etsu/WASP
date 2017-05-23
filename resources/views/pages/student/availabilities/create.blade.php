@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/student_availabilities.js') }}"></script>
@endpush

@section('title')
    Add Availabilities
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
        {{ Form::open(array('id'=>'availabilities','route' => 'studentHomeController.store_availabilities',
                             'class' => 'form-horizontal',
                             'method' => 'PATCH',
                             'role' => 'form')) }}
        <div class="form-group"></div>
        <div class="form-group row">
            {{ Form::label('start', 'Start Time',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-sm-4">
                {{ Form::input('time','start_time', null, array('class' => 'form-control'))  }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('end', 'End Time',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-sm-4">
                {{ Form::input('time','end_time', null, array('class' => 'form-control'))  }}

            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('semester', 'Semester',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-sm-4">
                {{ Form::select('semester', $semesters, null, array('class' => 'form-control','id'=>'semester')) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('weekday', 'Weekday',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-sm-4">
                {{ Form::select('weekday', $weekdays, null, array('class' => 'form-control','id'=>'weekday')) }}
            </div>
        </div>
        <hr/>
        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                <a class="btn btn-default" href="{{URL::to('studentAvailabilities')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.student_availabilities_view')
@stop
