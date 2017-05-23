@extends('template.layout_sidebar')

@section('title')
    Add Schedule
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
            {{ Form::open(array('id'=>'schedule',
                                'route' => 'schedules.store',
                                'class' => 'form-horizontal',
                                'role' => 'form')) }}
            <div class="form-group"></div>
            
            <div class="form-group">
                {{  Form::label('abbreviation', 'Abbreviation', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-5">
                    {{  Form::text('abbreviation',null, array('class' => 'form-control',
                                                              'placeholder' =>'For Example: F16B',
                                                              'maxlength' => '10',
                                                              'id' => 'abbr'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('description', 'Description', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-5">
                    {{  Form::text('description',null, array('class' => 'form-control',
                                                    'placeholder' => 'For Example: Fall 2016 Bumblebee',
                                                    'id' => 'description'))  }}
                </div>
            </div>

            @if (count($semesters) > 0)
                <div class="form-group">
                    {{ Form::label('semester_id', 'Semester:', array('for'=>'semester_id', 'class' => 'col-sm-2 control-label')) }}

                    <div class="col-sm-5">
                        {{ Form::select('semester_id', $semesters, ['class' => 'form-control' ]) }}
                    </div>
                </div>
            @endif

            @if (count($classrooms) > 0)
                <div class="form-group">
                    {{ Form::label('classroom_id', 'Classroom:', array('for'=>'classroom_id', 'class' => 'col-sm-2 control-label')) }}

                    <div class="col-sm-5">
                        {{ Form::select('classroom_id', $classrooms, ['class' => 'form-control' ]) }}
                    </div>
                </div>
            @endif
            
            <div class="form-group padding-top-2">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                    <a class="btn btn-default" href="{{URL::to('schedules')}}">Cancel</a>
                </div>
            </div>

            {{ Form::close() }}
    </div>
        @include('pages.modal.user_help.schedule_add')

@stop