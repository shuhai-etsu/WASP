@extends('template.layout_sidebar')

@section('title')
    Applications
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
<div>
    @section('table_headers')
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Submission Date</th>
            <th class="no-sort" style="width: 30px;">Action</th>
        </tr>
    @stop

    @section('table_rows')
        @foreach($application as $row)
            <tr>
                <td>{{$row->first_name}}</td>
                <td>{{$row->last_name}}</td>
                <td>{{$row->email}}</td>
                <td>{{ $row->type_id? $fin_aid_types[($row->type_id-1)]:'-' }}</td>
                <td>{{date("m/d/Y", strtotime($row->created_at))}}</td>
                <td>@include('template.table_button', array('button_link' => '/application/'.$row->id, 'button_text' => 'View'))</td>
            </tr>
        @endforeach
    @stop

    @include('template.table')

    @include('pages.modal.user_help.applications')
</div>
@stop