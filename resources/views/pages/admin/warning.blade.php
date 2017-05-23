@extends('template.layout_sidebar')

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/notification.js') }}"></script>
@endpush

@section('title')
    Warnings
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="row">

        @section('table_headers')
            <tr>
                <th>Date Received</th>
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
                    echo date("m/d/Y h:i:sa");?> </td>
                <td>Attack</td>
                <td>Cross-Site Scripting (XSS) is identified.</td>
                <td>@include('template.table_button', array('button_text' => 'Dismiss'))</td>
            </tr>
        @stop

        @include('template.table')
        <a data-toggle="modal" data-target="#confirmation_modal" class="btn btn-primary pull-left" style="position:relative;bottom: 34px;">Dismiss All</a>

        @include('pages.modal.confirm', array('action_description' => 'dismiss all warnings', 'action' => 'Dismiss All'))
        @include('pages.modal.user_help.warning')
    </div>
@stop
