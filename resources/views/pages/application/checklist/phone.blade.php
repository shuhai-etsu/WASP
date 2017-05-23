@extends('template.layout_no_sidebar')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />
    <style type="text/css">
        .bigFont li{
            font-size:20px;
        }
    </style>

    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/application_checklist.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/cell_phone_guidelines.js') }}"></script>
    @endpush
@stop

@section('title')
    Cell Phone Use
    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@section('page')
    <div class="row">
        <p class="lead">Guidelines:</p>
        <ul>
            <li><p>While supervising children, cell phone use is limited to Child Study Center/Little Buccaneers-related business and/or emergencies.</p></li>
            <li><p> Full-time staff members are responsible for keeping families informed about their children. Therefore, they are authorized to use their cell phones.<p></li>
            <li><p> Student staff should observe full-time staff demonstrating exemplary cell phone protocols at all times.<p></li>
            <li><p> Student employee cell phones must be kept COMPLETELY out-of-sight while supervising children (in a purse, backpack, etc.). THIS MEANS DURING NAPTIME AS WELL! It is not acceptable to keep a phone in your pocket.<p></li>
            <li><p> If you have a potential emergency, such as a sick family member, inform your supervising teacher than you need to leave the area in which you are supervising children to check your messages periodically.<p></li>
            <li><p> Cell phone use is only acceptable during breaks, when supervision of children is not an issue.</li>
            <li><p> When full-time staff are out of the classroom for staff meetings, family conferences, etc., they will designate a student staff member to be responsible for making ‘emergency’ contact with a full-time staff member, should the need arise. This is the only time a student employee can have a cell phone visible.<p></li>
            <li><p> All full-time staff are responsible for helping administration to enforce the cell phone guidelines with student staff.<p></li>
            <li><p> If it is observed that the cell phone use guidelines are being disregarded, the offending staff member will lose the right to have their cell phone on-site.<p></li>
        </ul>
        <br/>
        <p>
            I have reviewed and agree to abide by the above cell phone use guidelines. If I do not follow these guidelines, I understand my cell phone (or other electronic device) will be taken from me until my assigned work shift has ended.
        </p>
        <hr/>
        {{ Form::open(array('id' => 'phone_guidelines','method'=>'post','onSubmit'=>'return false;', 'class'=>'form-horizontal')) }}
            <div class="form-group row">
                <label for="accept_check">Check here if you accept these terms : </label>
                <input id="accept_check" name="accept_check" type="checkbox">
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
                <button id="save-btn" class="btn btn-primary" role="submit">Save</button>
                <a class="btn btn-primary" href="/checklist" role="button">Go to Checklist</a>
            </div>
        {{ Form::close() }}
    </div>

    @include('pages.modal.add_emergency_help_modal')
@stop