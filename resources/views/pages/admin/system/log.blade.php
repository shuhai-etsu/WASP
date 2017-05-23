@extends('template.layout_sidebar')

@section('title')
    Activity Log
    <a  data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    @include('template.table')
    
    @section('table_headers')
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>User</th>
            <th>Update</th>
        </tr>
    @stop

    @section('table_rows')
        <tr>
            <td>1</td>
            <td>04/24/2016</td>
            <td>Mickey Mouse</td>
            <td>Changed name in student table to "John Doe"</td>
        </tr>

        <tr>
            <td>2</td>
            <td>001/03/2016</td>
            <td>Etsu Buccaneer</td>
            <td>Deleted application</td>
        </tr>

        <tr>
            <td>3</td>
            <td>08/18/2015</td>
            <td>Harry Potter</td>
            <td>Changed Schedule</td>
        </tr>
    @stop
    
<!--     @include('pages.modal.user_help.log') -->

<!--     {{dd(Log::getMonolog());}} -->
@stop