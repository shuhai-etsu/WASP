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

        {{ Form::open( ['route' => 'financial_aid_recipient_report', 'class'=>'form-horizontal', 'role'=>'form']) }}

        <div class="form-group">
            {{  Form::label('financial_aid', 'Financial Aid Types:', array('class' => 'col-sm-3 control-label')) }}

            <div class="col-sm-6">
                {!! Form::select('financial_aid_types[]', $data, null, ['class' => 'form-control',
                                                                        'name' => 'financial_aid_types[]',
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

