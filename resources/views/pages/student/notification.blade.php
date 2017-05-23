@extends('template.layout_sidebar')

@push('css')
    <link rel="stylesheet" href="{{ URL::asset('css/studentProfile.css') }}" type="text/css"/>
@endpush
@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/notification.js') }}"></script>
@endpush

@section('title')

    Notifications

    <a data-toggle="modal" data-target="#helpModal"><span
                class="glyphicon glyphicon-question-sign"></span></a>

@endsection

@section('page')
    <div class="row">
        @section('table_headers')
            <tr>
                <th class="nowrap">Date Received</th>
                <th>Type</th>
                <th>Detail</th>
                <th class="no-sort nowrap">Action</th>
            </tr>
        @stop
        @section('table_rows')
            <tr>
                <td>
                    <?php
                    date_default_timezone_set("America/New_York");
                    echo date("m/d/Y h:i:sa");?></td>
                </td>
                <td>Pending Application</td>
                <td>Application:LB/CSCI is holding your application
                    as you are still missing transcripts or certifications which are required to complete the
                    application.
                </td>
                <td><span class="btn btn-primary pull-left">Dismiss</span></td>
            </tr>
            <tr>
                <td><?php
                    date_default_timezone_set("Pacific/Nauru");
                    echo date("m/d/Y h:i:sa");?></td>
                <td>New Application</td>
                <td>Application:Your application has been created.
                    For further application status, please check a confirmation e-mail and notification to your
                    application account/mobile.
                </td>
                <td><span class="btn btn-primary pull-left">Dismiss</span></td>
            </tr>
        @stop
        @include('template.table')
        <span class="btn btn-primary pull-left" style="position:relative;bottom: 34px;">Dismiss All</span>
    </div>
    </div>
    </div>

    @include('pages.modal.user_help.notification')
@stop
