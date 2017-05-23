@extends('layouts.wasp')

@section('content')


    <div class="container">

        <div class="form-group">
            <div class="col-sm-12 control-label">
                <br/>
                <h3><b>Certifications Coming Due Report Criteria</b></h3>
                <br/>
            </div>
        </div>

        {{ Form::open( ['route' => 'certifications_coming_due_report', 'class'=>'form-horizontal', 'role'=>'form']) }}

        <div class="form-group">
            {{  Form::label('date', 'Date Range:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-1 col-sm-1">
                {{ Form::select('days', [' ' => ' ', '15' => '15','30' => '30',
                                                     '60' => '60','120' => '120',
                                                     '240' => '240', '365' => '365']) }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('certification', 'Certification Types:', array('class' => 'col-sm-3 control-label')) }}

            <div class="col-sm-6">
                {!! Form::select('certification_types[]', $data, null, ['class' => 'form-control',
                                                                         'name' => 'certification_types[]',
                                                                         'size' => '8',
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

