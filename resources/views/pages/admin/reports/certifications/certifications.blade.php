@extends('template.layout_sidebar')

@push('javascript')

@endpush

@section('title')
    Employee Certification Report Criteria
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
        {{ Form::open( ['route' => 'user_certifications_report', 'class'=>'form-horizontal', 'role'=>'form']) }}
        <div class="form-group"></div>
        <div class="form-group">
            {{  Form::label('user', 'Employees:', array('class' => 'col-sm-2 control-label')) }}

            <div class="col-sm-5">
                {!! Form::select('users[]', $users, null, ['class' => 'form-control',
                                                                      'name' => 'users[]',
                                                                      'size' => '20',
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
    @include('pages.modal.user_help.employee_certification_report')
@stop