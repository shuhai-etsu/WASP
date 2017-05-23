@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/student_certifications.js') }}"></script>
@endpush

@section('title')
    Add Certifications
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
        {{ Form::open(array('id'=>'certifications','route' => 'studentHomeController.store_certifications',
                             'class' => 'form-horizontal',
                             'method' => 'PATCH',
                             'role' => 'form')) }}
     <div class="form-group">
        {{  Form::hidden('user_id', Auth::id()) }}

    </div>
    <div class="form-group row">
        {{ Form::label('cert', 'Name',['class'=>'col-xs-2 col-form-label'])  }}
        <div class="col-sm-4">
            {{ Form::select('cert', $cert, null, array('class' => 'form-control','id'=>'cert'))  }}

        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('date_certified', 'Certification Date',['class'=>'col-xs-2 col-form-label'])  }}
        <div class="col-sm-4">
            <div name="certified" id="certified"></div>
        </div>
    </div>
    <div class="form-group row">
        {{ Form::label('expiration_date', 'Expiration Date',['class'=>'col-xs-2 col-form-label'])  }}
        <div class="col-sm-4">
            <div name="expiration" id="expiration"></div>
        </div>
    </div>
    <hr/>
    <div class="form-group padding-top-2">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
            <a class="btn btn-default" href="{{URL::to('studentCertification')}}">Cancel</a>
        </div>
    </div>
    {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.student_certification_view')
@stop
