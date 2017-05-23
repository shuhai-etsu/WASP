@extends('template.layout_sidebar')

@section('title')
    Emergency Contact
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@endsection

@section('page')
    <div class="margin-left-2 list-table">
        @if($emergency_contact)
            @section('table_headers')
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Relation</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th class="no-sort" style="width: 30px;">Action</th>
                </tr>
            @stop

            @section('table_rows')
                @foreach( $emergency_contact as $row)
                <tr>
                    <td>{{$row->first_name}}</td>
                    <td>{{$row->last_name}}</td>
                    <td>{{$relationships[$row->relationship_id-1]}}</td>
                    <td>{{$row->telephone_number}}</td>
                    <td>{{$row->email}}</td>
                    <td>@include('template.table_button',array('button_link'=> URL::to('/studentEmergencyContact/'.$row->id.'/edit')))</td>
                </tr>
                @endforeach
            @stop
        @endif
    @include('template.table')
    </div>
<div class="row">
    <a id="emergency_contact_id" class="btn btn-primary pull-left" href="{{URL::to('/studentEmergencyContact/create')}}" style="position:relative;bottom: 34px;">New Emergency Contact</a>
</div>
@include('pages.modal.user_help.student_emergencyContact_view')
@endsection