@extends('template.layout_sidebar')

@push('css')
    <link rel="stylesheet" href="{{ URL::asset('css/studentProfile.css') }}" type="text/css" />
@endpush

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/notification.js') }}"></script>
@endpush

@section('title')
    Notifications
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="row">
        @section('table_headers')
            <tr name="list001">
                <th class="nowrap">Date Received</th>
                <th>Type</th>
                <th>Detail</th>
                <th class="no-sort nowrap" style="width: 30px;">Action</th>
            </tr>
        @stop

        @section('table_rows')
            <tr>
                <td >
                    <?php
                    date_default_timezone_set("America/New_York");
                    echo  date("m/d/Y h:i:sa");?></td></td>
                <td>Pending Application</td>
                <td>Application: Your application has been created.
                    For further application status, please check a confirmation e-mail and notification to your application account/mobile.</td>
                <td>@include('template.table_button', array('button_text' => 'Dismiss'))</td>
            </tr>

            <tr>
                <td><?php
                    date_default_timezone_set("Pacific/Nauru");
                    echo  date("m/d/Y h:i:sa");?></td>
                <td>New Application</td>
                <td>Application: John Doe has request a new application.</td>
                <td>@include('template.table_button', array('button_text' => 'Dismiss'))</td>
            </tr>

            <tr>
                <td data-field="created" data-sortable="true">

                    <?php
                    date_default_timezone_set("America/New_York");
                    echo  date("m/d/Y h:i:sa");?></td></td>
                <td>Expiring Certification</td>
                <td>Certification: Catherine's CPR will be expired on 2 days.</td>
                <td>@include('template.table_button', array('button_text' => 'Dismiss'))</td>
            </tr>

            <tr>
                <td><?php
                    date_default_timezone_set("Pacific/Nauru");
                    echo  date("m/d/Y h:i:sa");?></td>
                <td>Licence Renewal</td>
                <td>License: Zach's license needs to be renewed within 7 business day.</td>
                <td>@include('template.table_button', array('button_text' => 'Dismiss'))</td>
            </tr>
        @stop
        @include('template.table')

        <a data-toggle="modal" data-target="#confirmation_modal" class="btn btn-primary pull-left" style="position:relative;bottom: 34px;">Dismiss All</a>
        
        @include('pages.modal.confirm', array('action_description' => 'dismiss all notifications', 'action' => 'Dismiss All'))

        @include('pages.modal.user_help.notification')
    </div>
@stop