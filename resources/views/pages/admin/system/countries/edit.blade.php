@extends('template.layout_sidebar')

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/configuration_validation.js') }}"></script>
@endpush
@section('title')

    Edit Country

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
        {{ Form::model($data, array('id'=>'configuration','route' => array('countries.update', $data->id),
                              'class' => 'form-horizontal',
                              'role' => 'form',
                              'method' => 'PATCH')) }}
        <div class="form-group">
            {{  Form::hidden('id', $data->id) }}
        </div>
        <div class="form-group">
            {{  Form::label('abbreviation', 'Abbreviation', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('abbreviation',null, array('class' => 'form-control',
                                                          'placeholder' =>'For Example: USA',
                                                          'maxlength' => '10',
                                                          'id' => 'abbr'))  }}
            </div>
        </div>
        <div class="form-group">
            {{  Form::label('description', 'Description', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('description',null, array('class' => 'form-control',
                                                'placeholder' => 'For Example: United States of America',
                                                'id' => 'description'))  }}
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
                <a data-toggle="modal" data-target="#delete_modal" class="btn btn-danger">Delete</a>
                <a class="btn btn-default" href="{{URL::to('countries')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    @include('pages.modal.delete', array('item'=>(object)array('name' => $data->description, 'type' => 'countries', 'id'=>$data->id)))
    @include('pages.modal.user_help.systems')
@stop

