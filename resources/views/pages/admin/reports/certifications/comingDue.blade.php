@extends('template.layout_sidebar')

@push('javascript')
@endpush

@section('title')
    Certifications Coming Due Report Criteria
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
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
        {{ Form::open( ['route' => 'certifications_coming_due_report', 'class'=>'form-horizontal', 'role'=>'form']) }}
        <div class="form-group"></div>
        
        <div class="form-group">
            {{  Form::label('date', 'Date Range:', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-5">
                {{ Form::select('days', [' ' => ' ', '15' => '15','30' => '30',
                                                     '60' => '60','120' => '120',
                                                     '240' => '240', '365' => '365']) }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('certification', 'Certification Types:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-5">
                {!! Form::select('certification_types[]', $data, null, ['class' => 'form-control',
                                                                         'name' => 'certification_types[]',
                                                                         'size' => '8',
                                                                         'multiple'=>'multiple']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-5">
                {{  Form::submit('Generate Report', array('class' => 'btn btn-primary'))  }}
            </div>
        </div>

        {{ Form::close() }}
    </div>
@stop