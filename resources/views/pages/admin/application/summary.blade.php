@extends('template.layout_sidebar')

@section('title')
    {{$user->first_name." ".$user->middle_name." ".$user->last_name}}'s Application
@endsection

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/application_summary.js') }}"></script>
@endpush

@section('page')
    <h3>Application Status - {{$application_status}}</h3>
    <div class="row col-md-12">
        <div class="panel panel-info col-md-6 ">
            <div class="panel-heading">Availabilities</div>
            {{--<div class="panel-body">--}}
                <ul class="list-group">
                    @foreach($user_availability as $availability)
                       <li class="list-group-item">{{$availability->semester_desc}} - {{$availability->week_desc}}: {{$availability->start_time}} - {{$availability->end_time}}</li>
                    @endforeach
                </ul>
            {{--</div>--}}
        </div>
    </div>

    <div class="form-group row">
        <label for="first_name" class="col-xs-2 col-form-label">First Name</label>
        <div class="col-xs-3">
            {{$user->first_name}}
        </div>
    </div>

    <div class="form-group row">
        <label for="middle_name" class="col-xs-2 col-form-label">Middle Name</label>
        <div class="col-xs-3">
            {{$user->middle_name}}
        </div>
    </div>

    <div class="form-group row">
        <label for="last_name" class="col-xs-2 col-form-label">Last Name</label>
        <div class="col-xs-3">
            {{$user->last_name}}
        </div>
    </div>

    @if(isset($address))
        <div class="form-group row">
            <label for="address" class="col-xs-2 col-form-label">Address</label>
            <div class="col-xs-5">
                {{(($address->address1)? $address->address1: "")." ".(($address->address2)? $address->address: "")}}
            </div>
        </div>


        <div class="form-group row">
            <label for="city" class="col-xs-2 col-form-label">City</label>
            <div class="col-xs-4">
                {{$address->city}}
            </div>
        </div>

        <div class="form-group row">
            <label for="state" class="col-xs-2 col-form-label">State</label>
            <div class="col-xs-2">
                {{$states[$address->state_id-1]}}
            </div>
        </div>

        <div class="form-group row">
            <label for="zip_code" class="col-xs-2 col-form-label">Zip Code</label>
            <div class="col-xs-2">
                {{$address->zipcode}}
            </div>
        </div>
    @endif


    <div class="form-group row">
        <label for="student_phone" class="col-xs-2 col-form-label">Telephone</label>
        <div class="col-xs-2">
            {{$user->telephones->first()->telephone_number}}
        </div>
    </div>

    <div class="form-group row">
        <label for="student_email" class="col-xs-2 col-form-label">Email</label>
        <div class="col-xs-4">
            {{$user->email}}
        </div>
    </div>

    <hr/>

    <div class="form-group">
        <label for="worker_type">I qualify through the Office of Financial Aid for the following position(s):</label>
        @php
            foreach($aids as $aid)
            {
                echo "<br/>".$fin_aid_types[$aid->type_id-1];

            }
        @endphp
    </div>

    <hr/>

    @foreach($work_experiences as $work)
        <div class="form-group row">
            <label>Previously worked at :</label> <p>{{$work->company_name}}</p>
            <label>Left on :</label> <p>{{$work->date_left}}</p>
            <label>Reason for leaving :</label><p>{{$work->reason_for_leaving}}</p>
        </div>
    @endforeach
    <hr />

    @foreach($education_history as $education)
        <div class="form-group row">
            <label>Institution :</label> <p>{{$education->institution}}</p>
            <label>Degree :</label> <p>{{$education->description}}</p>
            <label>Graduation Date :</label><p>{{$education->graduation_date->format('Y-m-d')}}</p>
        </div>
    @endforeach
    <hr />
    
    @php
        $philosophy_text = ['philosophy_1'=>'Please describe your philosophy of working with young children ages 0 - 2 years.',
                            'philosophy_2'=>'Please describe your philosophy of working with young children ages 3 - 5 years.',
                            'philosophy_3'=>'Describe the abilities that qualify you to work effectively with young children.'];
    @endphp

    @php 
        foreach($philosophies as $philosophy){
    @endphp
    <div class="form-group">
        <label for="{{'philosophy_'.($philosophy->type_id-1)}}">
            {{$philosophy_text['philosophy_'.($philosophy->type_id-1)]}}
        </label>
        <br/>
        <div class="col-md-12">
            {{$philosophy->philosophy}}
        </div>
    </div>
    @php}@endphp

    <br/>
    <div class="form-group">
        <br/>
        <h4 class="bold">References</h4>
    </div>
    <hr />

    @php foreach($references as $reference){
    @endphp
        <div class="form-group row">
        <label for="reference_name_1" class="col-xs-2 col-form-label">Name</label>
        <div class="col-xs-6">
            {{$reference->first_name." ".(($reference->middle_name)? ($reference->middle_name." "):"").$reference->last_name}}
        </div>
    </div>

    <div class="form-group row">
        <label for="reference_phone_1" class="col-xs-2 col-form-label">Telephone</label>
        <div class="col-xs-4">
            {{$reference->telephone_number}}
        </div>
    </div>

    <hr />
    @php}@endphp

    <div class="row">
        <div class="pull-left col-md-5">
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0);" onclick="changeStatus({{$user->id}},{{config('constants.user_status.PENDING')}}); return false;">Accept</a></li>
                <li><a href="javascript:void(0);" onclick="changeStatus({{$user->id}},{{config('constants.user_status.INTERVIEW')}}); return false;">Interview</a></li>
                <li><a href="javascript:void(0);" onclick="changeStatus({{$user->id}},{{config('constants.user_status.SHELVED')}}); return false;">Defer</a></li>
                <li><a href="javascript:void(0);" onclick="changeStatus({{$user->id}},{{config('constants.user_status.REJECTED')}}); return false;">Reject</a></li>
                <li><a data-toggle="modal" data-target="#cancel_modal">Cancel</a></li>
            </ul>
        </div>
    </div>

    @include('pages.modal.cancel', array('action_route' => 'javascript:history.back();'))

@stop