@extends('template.layout_no_sidebar')
@section('head')
    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/application_checklist.js') }}"></script>
    @endpush
@stop

@section('title')
    Documents Upload
    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@section('page')
    <div class="row">
        <div>
            <div class="margin-left-2 list-table">
                <a class="btn btn-primary" href="/checklist" role="button">Go to Checklist</a>
                <br><br>
                
                @section('table_headers')
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Expiration Date</th>
                        <th>Comments</th>
                        <th class="no-sort nowrap" style="width: 30px;">Action</th>
                    </tr>
                @stop

                @section('table_rows')
                    @foreach($documents as $document)
                        <tr>
                            <td>
                                {{ $document->name }}
                            </td>
                            <td>
                                {{ $document->type->description }}
                            </td>

                            <td>
                                {{ date('m/d/Y',strtotime($document->expiration_date)) }}
                            </td>
                            <td>
                                {{ $document->comment }}
                            </td>
                            <td>
                                @include('template.table_button', array('button_link'=> URL::to('documents/'.$document->id.'/edit')))
                            </td>
                        </tr>
                    @endforeach
                @stop
                @include('template.table')
            </div>
        </div>

        <div class="col-xs-3 form-group row">
            <a title="Upload Documents" class="btn btn-primary pull-left" href="{{URL::to('documents/create')}}" style="position:relative;bottom: 34px;">Upload Document</a>
        </div>
    </div>
    @include('pages.modal.add_emergency_help_modal')
@stop