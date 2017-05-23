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
        <script type="text/javascript" src="{{ URL::asset('js/sa_job_description.js') }}"></script>
    @endpush
@stop

@section('title')
    Student Assistant Job Description
    <a data-toggle="modal" data-target="#addEmergencyHelpModal"><span class="glyphicon glyphicon-question-sign"></span></a>
@stop

@section('page')
    <div class="row">
        <p>
            As a Student Assistant, you have been hired as a member of a support team for either the Infant, Toddler, or Preschool programs at the Child Study Center (CSC)/Little Buccaneers. You will be under the supervision of a Child Care Specialist, Teacher 1, and/or Master Teacher in the program for which you work. In general, your role is to assist the full-time teacher in all daily tasks that go together to provide a safe, healthy, and positive learning environment for the children.
        </p>
        <p class="lead">
            Responsibilities:
        </p>
        <ul>
            <li><p> stay within sight, sound, and easy reach of the children at all times</p></li>
            <li><p> housekeeping tasks are undertaken only after attending to immediate needs of the children</p></li>
            <li><p> most communication with other adults in the environment is related to issues related to the care of the children</p></li>
            <li><p> complete all tasks as assigned by supervising staff</p></li>
            <li><p> supervise and encourage outdoor play</p></li>
            <li><p> strive to provide appropriate, responsive, and respectful caregiving</p></li>
            <li><p> demonstrate a positive attitude in his/her work with the children, families, coworkers, student observers, and visitors</p></li>
            <li><p> follow licensing and National Association for the Education of Young Children (NAEYC) accreditation guidelines for the care of young children</p></li>
            <li><p> read, sign, and otherwise “take care of” all paperwork required for working at CSC/Little Bucs (hiring procedures with the Executive Aide, reading the handbook, and other paperwork included in the hiring packet)</p></li>
            <li><p> comply with the dress code as stated in the Student Staff Handbook</p></li>
            <li><p> understand and follow the guidance policy for young children as described in the Student Staff Handbook</p></li>
            <li><p> share with full-time staff and child/class-related “incidents” that may need attention</p></li>
            <li><p> stay current on required training (child abuse prevention, Developmentally Appropriate Practices video, transcripts, blood-borne pathogens, etc.)</p></li>
            <li><p> understand to work at CSC/Little Bucs, there is a minimum of 18 in-service hours that must be completed per licensing year (18 hours is usually covered by orientation and the semester’s coursework)</p></li>
            <li><p> submit proof of fingerprinting within ten days of hiring</p></li>
            <li><p> submit a health form within ten days of hiring and every two years thereafter</p></li>
            <li><p> submit three references</p></li>
            <li><p> submit a schedule of classes to the Master Teacher at the end of the current semester for the upcoming semester</p></li>
            <li><p> submit a written two-week notice if not planning to return after a particular semester or if it is necessary to resign during a semester</p></li>
        </ul>
        <hr>
        <p class="lead">
            Attendance:
        </p>
        <ul>
            <li><p> arrive promptly and attend consistently (as continued employment is a dependent upon this)</p></li>
            <li><p> is responsible for contacting or having someone to contact the Master Teacher in case of an emergency absence</p></li>
            <li><p> make every effort possible to obtain a substitute when an absence is necessary</p></li>
            <li><p> take responsibility for completing the appropriate leave form for time off</p></li>
            <li><p> work with the Master Teacher to arrange time off for semester breaks, holidays, and finals week</p></li>
        </ul>
        <hr>
        <p class="lead">
            Primary responsibilities when working with young children are:
        </p>
        <ul>
            <li><p> participating in appropriate interactions </p></li>
            <li><p> maintaining a healthy, safe environment </p></li>
        </ul>
        <br>
        {{ Form::open(array('id' => 'job_description','method'=>'post','onSubmit'=>'return false;', 'class'=>'form-horizontal')) }}
            <div class="form-group row">
                <label for="accept_check">Check here if you accept these terms : </label>
                <input id="accept_check" type="checkbox">
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