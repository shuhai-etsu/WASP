@extends('template.layout_no_sidebar')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />
    @push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/documents_upload.js') }}"></script>
    @endpush
@stop

@section('title')
    Edit Document
@stop

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
        {{ Form::model($data, array('id'=>'upload_document','route' => array('documents.update', $data->id),
                                    'class' => 'form-horizontal',
                                    'role' => 'form',
                                    'files'=> 'true',
                                    'method' => 'PUT')) }}
        <div class="form-group">
            {{  Form::hidden('id', $data->id) }}
        </div>

        <div class="form-group">
            {{  Form::label('name', 'Document Name', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::text('name',$data->name, array('class' => 'form-control',
                                                          'maxlength' => '30',
                                                          'id' => 'name'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('type', 'Document Type', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{  Form::select('type',$types,($data->type_id-1), array('id' => 'type'))  }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('expiration_date', 'Expires On',array('class'=>'control-label col-sm-2'))  }}
            <div class="col-xs-3">
                {{  Form::text('expiration_date',date('m/d/Y',strtotime($data->expiration_date)), array('id' => 'expiration_date'))  }}
            </div>
        </div>

        <div class="form-group">
            {{  Form::label('comment', 'Comments', array('class' => 'control-label col-sm-2')) }}
            <div class="col-sm-5">
                {{ Form::textarea('comment', $data->comment, array('class' => 'form-control',
                                                                    'placeholder'=>'Up to 255 Characters',
                                                                    'id'=>'comment',
                                                                    )) }}
            </div>
        </div>

        <div class="form-group padding-top-2">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                <a data-toggle="modal" data-target="#delete_modal" class="btn btn-danger">Delete</a>
                <a class="btn btn-default" href="{{URL::to('documents')}}">Cancel</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>

    @include('pages.modal.delete', array('item'=>(object)array('name' => $data->description, 'type' => 'documents', 'id'=>$data->id)))
@stop