@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/configuration_validation.js') }}"></script>
@endpush
@section('title')

    Add Degree Types

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
        {{ Form::open(array('id'=>'configuration','route' => 'degree_types.store',
                              'class' => 'form-horizontal',
                              'role' => 'form')) }}
        <div class="form-group"></div>
        <div class="form-group">
            <div class="form-group">
                {{  Form::label('abbreviation', 'Abbreviation', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-5">
                    {{  Form::text('abbreviation',null, array('class' => 'form-control',
                                                    'placeholder' => 'For Example: G',
                                                    'id' => 'abbr'))  }}
                </div>
            </div>
            {{  Form::label('description', 'Description', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('description',null, array('class' => 'form-control',
                                                          'placeholder' =>'For Example: Graduate',
                                                          'maxlength' => '10',
                                                          'id' => 'description'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('comment', 'Comments', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{ Form::textarea('comment', null, array('class' => 'form-control',
                                                                    'placeholder'=>'Up to 255 Characters',
                                                                    'id'=>'comments',
                                                                    )) }}
            </div>
        </div>
        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                {{--<input type="submit" class="btn btn-primary" id="save_degree" value="Save"/>--}}
                {{ Form::submit('Save', array('class' => 'btn btn-primary', 'id' => 'save_degree_types', 'name' => 'Save')) }}
                <a class="btn btn-default" href="{{URL::to('degree_types')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.configurations')
@stop
