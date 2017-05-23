@extends('template.layout_no_sidebar')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />
    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/documents_upload.js') }}"></script>
    @endpush
@stop



@section('title')
    Documents Upload
    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

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
    <div class="row">
        <div class="row add-form create-form">
            {{ Form::open(array('id' => 'upload_document','route' => 'documents.store',
                'class'=>'form-horizontal',
                'role'=>'form',
                'files'=>'true')) }}
            <div class="form-group"></div>
            <div class="form-group">
                {{  Form::label('name', 'Document Name', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-5">
                    {{  Form::text('name',null, array('class' => 'form-control',
                                                              'maxlength' => '30',
                                                              'id' => 'name'))  }}
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('type', 'Document Type', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-5">
                    {{  Form::select('type',$types, array('id' => 'type'))  }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('expiration_date', 'Expires On',array('class'=>'control-label col-sm-2'))  }}
                <div class="col-xs-3">
                    <div id="expiration_date" name="expiration_date"></div>
                </div>
            </div>

            <div class="form-group">
                {{  Form::label('comments', 'Comments', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-5">
                    {{ Form::textarea('comments', null, array('class' => 'form-control',
                                                                        'placeholder'=>'Up to 255 Characters',
                                                                        'id'=>'comments',
                                                                        )) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('document_image', 'Upload',array('class'=>'control-label col-sm-2'))  }}
                <div class="col-xs-3">
                    {{ Form::file('document_image') }}
                </div>
            </div>

            <div class="form-group padding-top-2">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="save-btn">Submit</button>
                    <a class="btn btn-default" href="{{URL::to('documents')}}">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    @include('pages.modal.add_emergency_help_modal')
    @include('pages.modal.confirm', array('action_description' => 'delete this document', 'action' => 'Delete','action_route'=>'/destroy/'))
@stop