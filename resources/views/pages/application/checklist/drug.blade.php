@extends('template.layout_no_sidebar')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />

    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/application_checklist.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/drug_testing.js') }}"></script>
    @endpush
@stop

@section('title')
    Acknowledgement of Receipt and Understanding of Reasonable Suspicion Drug Testing for Child Care Workers
    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@section('page')
    {{ Form::open(array('id' => 'drug_testing','method'=>'post','onSubmit'=>'return false;', 'class'=>'form-horizontal')) }}
        <div class="row">
            <p>
                I certify that I have received a copy of and have read the East Tennessee State University Child Study Center’s/Little Buccaneers Student Child Care Center’s policy on Reasonable Suspicion Drug Testing for Child Care Workers. The policy has been explained to me, and I have had the opportunity to ask questions about it. I understand that, as identified by my supervisor, if my performance indicates that there is a reasonable suspicion to believe that I am using or am under the influence of illegal drugs, I must submit to a urine drug test. I also understand that my refusal to submit to a drug test, failure to provide adequate urine for testing without a valid medical explanation, or a positive result following a drug test subjects me to immediate disciplinary action up to and including termination.
            </p>
        </div>
        <hr/>

        <div class="form-group row">
            <label class="col-form-label">Check here if you accept these terms : </label>
            <input type="checkbox" id="accept_check" >
        </div>

        <div class="form-group row">
            <label for="name_signature" class="col-sm-1 col-form-label">Signature</label>
            <div class="col-xs-3">
                <input type="text" class="form-control" id="name_signature">
            </div>
        </div>

        <div class="form-group row">
            <label for="date_picker" class="col-sm-1 col-form-label">Date</label>
            <div class="col-xs-3">
                <div style="pointer-events: none;" id="date_picker"></div>
            </div>
        </div>

        <div class="form-group row">
            <button id="save-btn" class="btn btn-primary" type="submit">Save</button>
            <a class="btn btn-primary" href="/checklist" type="button">Go to Checklist</a>
        </div>
    {{ Form::close() }}
    @include('pages.modal.add_emergency_help_modal')
@stop