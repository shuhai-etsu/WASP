@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/semester_validation.js') }}"></script>
    <script>
        $(document).ready(function () {
            //set the value of start and end datepickers

            // Split start_date timestamp into [ Y, M, D, h, m, s ]
            var t = '{{ $data->start_date }}'.split(/[- :]/);
            // Apply each element to the Date function
            var d = new Date(t[0], t[1]-1, t[2]);
            $('#start_date').jqxDateTimeInput('setDate',d);

            // Split end_date into [ Y, M, D, h, m, s ]
            t='{{ $data->end_date }}'.split(/[- :]/)
            // Apply each element to the Date function
            var d = new Date(t[0], t[1]-1, t[2]);
            $('#end_date').jqxDateTimeInput('setDate',d);
        });
    </script>
@endpush

@section('title')
    Edit Semester
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
        {{ Form::model($data, array('id'=>'configuration','route' => array('semesters.update', $data->id),
                              'class' => 'form-horizontal',
                              'role' => 'form',
                              'method' => 'PATCH')) }}

        <div class="form-group">
            {{  Form::hidden('id', $data->id) }}
        </div>

        <div class="form-group">
            {{  Form::label('abbreviation', 'Abbreviation', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('abbreviation',$data->abbreviation, array('class' => 'form-control',
                                                          'placeholder' =>'For Example: F2017',
                                                          'maxlength' => '10',
                                                          'id' => 'abbr'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('description', 'Description', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('description',$data->description, array('class' => 'form-control',
                                                'placeholder' => 'For Example: Fall of 2017',
                                                'id' => 'description'))  }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('start_date', 'Start Date',array('class'=>'col-sm-2 control-label'))  }}
            <div class="col-sm-5">
                <div name="start_date" id="start_date"></div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('end_date', 'End Date',array('class'=>'col-sm-2 control-label'))  }}
            <div class="col-sm-5">
                <div name="end_date" id="end_date"></div>
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('comments', 'Comments', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{ Form::textarea('comment', $data->comment, array('class' => 'form-control',
                                                                    'placeholder'=>'Up to 255 Characters',
                                                                    'id'=>'comments',
                                                                    )) }}
            </div>
        </div>

        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                <a data-toggle="modal" data-target="#delete_modal" class="btn btn-danger">Delete</a>
                <a class="btn btn-default" href="{{URL::to('semesters')}}">Cancel</a>
            </div>
        </div>

        {{ Form::close() }}
    </div>

    @include('pages.modal.delete', array('item'=>(object)array('name' => $data->description, 
                                                                'type' => 'semesters', 
                                                                'id'=>$data->id)))

    @include('pages.modal.user_help.systems')
@stop