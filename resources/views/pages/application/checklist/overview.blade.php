@extends('template.layout_no_sidebar')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />
    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/notification.js') }}"></script>
    @endpush
@stop

@section('title')
    Application Checklist
    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@section('page')
    @include('pages.modal.user_help.warning')
    <h4>Applicant name: <em>Noama Samreen</em> </h4>
    <hr>
    <div class="margin-left-2 list-table">
        @section('table_headers')
            <tr>
                <th>Description</th>
                <th>Completed at</th>
                <th class="no-sort nowrap" style="width: 30px;">Action</th>
            </tr>
        @stop

        @section('table_rows')
                <tr>
                    <td>Documents Upload</td>
                    <td></td>
                    <td><a class="btn btn-primary" href="/documents" role="button">View</a></td>
                </tr>

                <tr>
                    <td>Employee Emergency Information</td>
                    <td>10/18/2016 11:20 AM</td>
                    <td><a class="btn btn-primary" href="/emergency" role="button">View</a></td>
                </tr>

                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>10/18/2016 11:30 AM</td>
                        <td><a class="btn btn-primary" href="/checklist/{{$item->id}}" role="button">View</a></td>
                    </tr>
                @endforeach
        @stop
            @include('pages.modal.add_emergency_help_modal')
        @include('template.table')
    </div>

@stop