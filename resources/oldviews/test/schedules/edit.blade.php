@extends('layouts.wasp')

@section('content')

    <div class="container">
        {{ Form::model($data, array('route' => array('schedules.update', $data->id),
                                                     'class' => 'form-horizontal',
                                                     'role' => 'form',
                                                     'method' => 'PUT')) }}

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

        <div class="form-group">
            <div class="col-sm-12 control-label">
                <h3><b>Edit Schedule</b> - {{$data->description}}</h3>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <a href="/schedules/{!! $data->id !!}/scheduler">Schedule Workers</a>
                <br/>
                <br/>
            </div>
        </div>

        <div class="form-group">
            {{  Form::hidden('id', $data->id) }}
            {{  Form::label('abbreviation', 'Abbreviation:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{  Form::text('abbreviation', null, array('class' => 'form-control',
                                                                      'maxlength' => '10',
                                                                      'id' => 'abbreviation'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('description', 'Description:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-7">
                {{  Form::text('description', null, array('class' => 'form-control',
                                                                     'maxlength' => '50',
                                                                     'id' => 'description'))  }}
            </div>
        </div>

        @if (count($semesters) > 0)
            <div class="form-group">
                {{ Form::label('semester_id', 'Semester:', array('for'=>'semester_id', 'class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-7">
                    {{ Form::select('semester_id', $semesters, array($data->semester_id), array('id' => 'semesterID'),['class' => 'form-control' ]) }}
                </div>
            </div>
        @endif

        @if (count($classrooms) > 0)
            <div class="form-group">
                {{ Form::label('classroom_id', 'Classroom:', array('for'=>'classroom_id', 'class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-7">
                    {{ Form::select('classroom_id', $classrooms, array($data->classroom_id), array('id' => 'classroomID'),['class' => 'form-control' ]) }}
                </div>
            </div>
        @endif

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{  Form::submit('Save', array('class' => 'btn btn-info'))  }}
            </div>
        </div>

        {{ Form::close() }}
    </div>

@stop