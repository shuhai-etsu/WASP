@extends('template.layout_sidebar')

@push('javascript')
@endpush

@section('title')
    Availability Gaps Report
    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
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
    
    <div class="row create-form">
        {{ Form::open( ['route' => 'gaps_report', 'class'=>'form-horizontal', 'role'=>'form']) }}
        <div class="form-group"></div>

        @if (count($semesters) > 0)
            <div class="form-group">
                {{ Form::label('semester_id', 'Semester:', array('for'=>'semester_id', 'class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-7">
                    {{ Form::select('semester_id', $semesters, ['class' => 'form-control' ]) }}
                </div>
            </div>
        @endif

        @if (count($classrooms) > 0)
            <div class="form-group">
                {{ Form::label('classroom_id', 'Classroom:', array('for'=>'classroom_id', 'class' => 'col-sm-2 control-label')) }}

                <div class="col-sm-7">
                    {{ Form::select('classroom_id', $classrooms, ['class' => 'form-control' ]) }}
                </div>
            </div>
        @endif

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {{  Form::submit('Generate Report', array('class' => 'btn btn-primary'))  }}
            </div>
        </div>

        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.configurations')

@stop