@extends('layouts.wasp')

@section('content')


    <div class="container">

        <div class="form-group">
            <div class="col-sm-12 control-label">
                <br/>
                <h3><b>Employee Certification Report Criteria</b></h3>
                <br/>
            </div>
        </div>

        {{ Form::open( ['route' => 'user_certifications_report', 'class'=>'form-horizontal', 'role'=>'form']) }}

        <div class="form-group">
            {{  Form::label('user', 'Employees:', array('class' => 'col-sm-3 control-label')) }}

            <div class="col-sm-6">
                {!! Form::select('users[]', $users, null, ['class' => 'form-control',
                                                                      'name' => 'users[]',
                                                                      'size' => '20',
                                                                      'multiple'=>'multiple']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                {{  Form::submit('Generate Report', array('class' => 'btn btn-info'))  }}
            </div>
        </div>

        {{ Form::close() }}
    </div>
@stop

