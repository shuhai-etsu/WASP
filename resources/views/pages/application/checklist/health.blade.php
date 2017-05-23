@extends('template.layout_sidebar')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css" />
    <style type="text/css">
        .bigFont li{
            font-size:20px;
        }
        .bold-label{
            font-weight:bold;
            font-size:20px;
        }
    </style>
    @push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/application_checklist.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/employee_health_policy.js') }}"></script>
    @endpush
@stop

@section('title')

    Employee Health Policy

    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@stop
@section('page')
    <div class="row">
        <p>
            Child Study Center (CSC) and Little Bucs are committed to the health, safety, and well-being of all employees, children, and families, as well as complying with all health department regulations. Upon learning of new health regulations, our policies are updated and our staff and families are informed of these changes.
        </p>
        <br>
        <p>
            In an effort to ensure a healthy environment at CSC and Little Bucs, anyone who works in classrooms with children should report to a member of CSC or Little Bucs administration if they are experiencing any of the following symptoms:
        </p>
        <ul>
            <li><p>Diarrhea</p></li>
            <li><p>Fever</p></li>
            <li><p>Vomiting</p></li>
            <li><p>Jaundice</p></li>
            <li><p>Sore throat with fever</p></li>
            <li><p>Lesions (such as boils and infected wounds) containing pus on a finger, hand, or any exposed body part, regardless of size</p></li>
        </ul>
        <br>
        <p>
            Employees who support snacks, lunches, and experiences with food should also inform CSC or Little Bucs administration whenever diagnosed by a healthcare provider as being ill with any of the following diseases that can be transmitted through food or person-to-person by casual contract:
        </p>
        <ul>
            <li><p>Salmonellosis</p></li>
            <li><p>Shigellosis</p></li>
            <li><p>Escherichia coli (E. coli)</p></li>
            <li><p>Hepatitis A virus</p></li>
            <li><p>Norovirus </p></li>
        </ul>
        <br>
        <label for="note">PLEASE NOTE:  </label>
        <p id="note">
            TN Food Service Rules and Regulation 1200-23-1-02(1) states (in part) “to avoid unnecessary manual contact with food, suitable dispensing utensils shall be used by employees or provided to consumers who serve themselves.” The main reason for not touching ready-to-eat foods with bare hands is to prevent viruses and bacteria, which are present on your hands, from contaminating food. The following are utensils that can be used in delivery of ‘ready-to-eat’ foods:
        </p>
        <ul>
            <li><p>Tongs/spatulas</p></li>
            <li><p>Forks/spoons</p></li>
            <li><p>Deli paper/waxed paper/napkins</p></li>
            <li><p>Disposable gloves</p></li>
        </ul>
        <br>
        <p>
            Handwashing and Universal Precautions (from Staff and Student Handbooks)<br>
            The Child Study Center and Little Buccaneers programs follow these practices regarding handwashing:
        </p>
        <ul>
            <li><p>Handwashing is required as you enter the classroom, before interacting with children. Proper handwashing procedures to be followed are posted at each sink area.</p></li>
            <li><p>Handwashing also occurs at the following times:</p></li>
            <ul>
                <li><p>after diapering or using a toilet</p></li>
                <li><p> after handling any bodily fluids</p></li>
                <li><p> before and after meals and snacks; before preparing or serving food</p></li>
                <li><p> after playing in water</p></li>
                <li><p> after handling pets or other animals</p></li>
                <li><p> before and after feeding children</p></li>
                <li><p> before and after administering medication</p></li>
                <li><p> after assisting a child with toileting</p></li>
                <li><p> after handling garbage or cleaning</p></li>
                <li><p> after returning from outside play</p></li>
            </ul>
        </ul>
        <br>
        <hr/>
        {{ Form::open(array('id' => 'health_policy','method'=>'post','onSubmit'=>'return false;', 'class'=>'form-horizontal')) }}
            <div class="form-group row">
                <label>I understand and will serve all food (whether packaged or not) using one of the above methods :</label>
                <input type="checkbox" id="checkbox_1">
            </div>
            <div class="form-group row">
                <label>I understand I must wash my hands before putting on gloves and using utensils or paper products for food delivery :</label>
                <input id="checkbox_2" type="checkbox">
            </div>
            <div class="form-group row">
                <label>I understand I must adhere to all policies for handwashing as described above :</label>
                <input id="checkbox_3" type="checkbox">
            </div>
            <div class="form-group row">
                <label>Check here if you accept these terms :</label>
                <input id="accept_all" type="checkbox">
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