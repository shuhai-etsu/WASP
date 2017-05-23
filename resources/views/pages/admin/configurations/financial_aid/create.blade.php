@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/finaidtype_validation.js') }}"></script>
@endpush
@section('title')

    Add Financial Aid Type

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
        {{ Form::open(array('id'=>'configuration','route' => 'financial_aid_types.store',
                              'class' => 'form-horizontal',
                              'role' => 'form')) }}
        <div class="form-group"></div>
        <div class="form-group">
            {{  Form::label('abbreviation', 'Abbreviation', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('abbreviation',null, array('class' => 'form-control',
                                                          'placeholder' =>'For Example: APS',
                                                          'maxlength' => '10',
                                                          'id' => 'abbr'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('description', 'Description', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('description',null, array('class' => 'form-control',
                                                'placeholder' => 'For Example: Academic Performance Scholarship',
                                                'id' => 'description'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('max_hours', 'Maximum Hours', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('max_hours',null, array('class' => 'form-control',
                                                          'placeholder' =>'For Example: 10',
                                                          'maxlength' => '2',
                                                          'id' => 'max_hours'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('comments', 'Comments', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{ Form::textarea('comment', null, array('class' => 'form-control',
                                                                    'placeholder'=>'Up to 255 Characters',
                                                                    'id'=>'comments',
                                                                    )) }}
            </div>
        </div>
        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                <a class="btn btn-default" href="{{URL::to('financial_aid_types')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.configurations')
@stop
