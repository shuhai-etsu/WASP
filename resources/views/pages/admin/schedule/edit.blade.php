@extends('template.layout_sidebar')

@section('title')
    Edit Schedule
    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
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

        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save and Proceed</button>
                <a data-toggle="modal" data-target="#delete_modal" class="btn btn-danger">Delete</a>
                <a class="btn btn-default" href="{{URL::to('schedules')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
        @include('pages.modal.delete', array('item'=>(object)array('name' => $data->description, 'type' => 'schedules', 'id'=>$data->id)))
        @include('pages.modal.user_help.schedule_edit')
@stop