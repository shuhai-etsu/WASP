@extends('template.layout_sidebar')

@section('title')
    Personal Information
    <a data-toggle="modal" data-target="#helpModal"><span class="glyphicon glyphicon-question-sign"></span></a>

@endsection

@section('page')
@section('table_headers')
@section('table_rows')
    <tr>
        <th>First Name</th>
        <td>{{$data->first_name}}</td>
    </tr>
    <tr>
        <th>Middle Name</th>
        <td>{{$data->middle_name}}</td>
    </tr>
    <tr>
        <th>Last Name</th>
        <td>{{$data->last_name}}</td>
    </tr>
    @if($addresses)
    <tr>
        <th>Address</th>
            @foreach($addresses as $part)
        <td>{{$part->address1 .' '. $part->address2}}</td>
    </tr>
        @endforeach
    @endif
    @if($telephones)
        @foreach($telephones as $phone)
    <tr>
        <th>Telephone</th>
        <td>   {{$phone->telephone_number}}</td>

    </tr>
        @endforeach
    @endif


    <tr>
        <th>Alternate Email</th>
        <td>{{isset($data->alternate_email)? $data->alternate_email:''}}
            </td>
    </tr>

    @if($fin_aid)
        @foreach($fin_aid as $aid)
    <tr>
        <th>Financial Aid</th>
        <td>{{$aid->description}}</td>
    </tr>
        @endforeach
    @endif
@stop
@stop
@include('template.table')
@include('template.table_button', array('button_link'=> URL::to('/studentPersonalInformation/edit')))
@include('pages.modal.user_help.student_personalInformation_view')
@endsection