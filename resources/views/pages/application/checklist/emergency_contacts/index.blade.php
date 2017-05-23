@extends('template.layout_no_sidebar')

@section('title')
    Emergency Information
    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@section('page')
    <div class="row">
            <div class="margin-left-2 list-table">
                <a class="btn btn-primary" href="/checklist" role="button">Go to Checklist</a>
                <br><br>
                @section('table_headers')
                    <tr>
                        <th>Name</th>
                        <th>Relationship</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th class="no-sort nowrap" style="width: 30px;">Action</th>
                    </tr>
                @stop
                @section('table_rows')
                    @foreach($contacts as $contact)
                        <tr>
                            <td>
                                {{ $contact->first_name." ".$contact->middle_name." ".$contact->last_name }}
                            </td>
                            <td>
                                {{ $contact->relationship->description }}
                            </td>
                            <td>
                                {{ $contact->telephone_number }}
                            </td>
                            <td>
                                {{ $contact->email }}
                            </td>
                            <td>
                                @include('template.table_button', array('button_link'=> URL::to('emergency/'.$contact->id.'/edit')))
                            </td>
                        </tr>
                    @endforeach
                @stop
                @include('template.table')
            </div>
            <a class="btn btn-primary margin-left-2"  style="position:relative;bottom: 34px;" href="{{URL::to('emergency/create')}}">New Emergency Contact</a>
        </div>
        @include('pages.modal.add_emergency_help_modal')
@stop