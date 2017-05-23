@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/classroom_validation.js') }}"></script>
@endpush
@section('title')

    Add Classroom

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
        {{ Form::open(array('id'=>'configuration','route' => 'classrooms.store',
                              'class' => 'form-horizontal',
                              'role' => 'form')) }}
        <div class="form-group"></div>
        <div class="form-group">
            {{  Form::label('abbreviation', 'Abbreviation', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('abbreviation',null, array('class' => 'form-control',
                                                          'placeholder' =>'For Example: B',
                                                          'maxlength' => '10',
                                                          'id' => 'abbr'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('description', 'Description', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('description',null, array('class' => 'form-control',
                                                'placeholder' => 'For Example: Butterfly',
                                                'id' => 'description'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('minimum_students', 'Min Students', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('minimum_students',null, array('class' => 'form-control',
                                                'placeholder' => 'For Example: 6',
                                                'id' => 'minimum_students'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('maximum_students', 'Max Students', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('maximum_students',null, array('class' => 'form-control',
                                                'placeholder' => 'For Example: 20',
                                                'id' => 'maximum_students'))  }}
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
                <a class="btn btn-default" href="{{URL::to('classrooms')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.user_help.configurations')


    {{--Are the age groups and constraints still a feature?--}}

        {{--<div class="form-group">--}}
            {{--<label class="control-label col-sm-2" for="age-group">Age Group</label>--}}
            {{--<div class="col-sm-5">--}}
                {{--<select class="form-control" id="age-group">--}}
                    {{--<option selected disabled>Choose One</option>--}}
                    {{--<option>Infant</option>--}}
                    {{--<option>Toddler</option>--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label class="control-label col-sm-2" for="constraints">Constraints</label>--}}
            {{--<div class="col-sm-5">--}}
                {{--<select multiple class="form-control" id="constraints">--}}
                    {{--<option>CPR</option>--}}
                    {{--<option>First Aid</option>--}}
                    {{--<option>Female</option>--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
@stop