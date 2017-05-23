@extends('template.layout_no_sidebar')

@section('head')
    @push('css')
        <link rel="stylesheet" href="{{ URL::asset('css/studentApplication.css') }}" type="text/css"/>
    @endpush
    @push('javascript')
        <script type="text/javascript" src="{{ URL::asset('js/jquery-validation-1.16.0/dist/jquery.validate.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/validationFunctions.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/studentApplication.js') }}"></script>
    @endpush
@endsection

@section('page')
    <h3>ETSU Child Study Center Student Worker Application</h3>
    <hr/>
    @if (count($errors) > 0)
        <div class="form-group col-sm-10">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{ Form::open(['action' => 'ApplicationController@store',
                    'id' => 'application_form',
                    'method'=>'post', 
                    'class' => 'row student-application-form',
                    'role' => 'form']) }}

    <fieldset>
        <h3>Personal Information</h3>
        <hr/>
        <div class="form-group row">
            {{ Form::label('enumber', 'Enumber',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','enumber', null, array('id'=>'enumber', 'class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('first_name', 'First Name',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','first_name', null,array('id'=>'first_name','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('middle_name', 'Middle Name',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','middle_name', null,array('id'=>'middle_name','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('last_name', 'Last Name',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','last_name', null,array('id'=>'last_name','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('suffix', 'Suffix',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{  Form::select('suffix' , $suffixes,null, ['id' => 'suffix', 'class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('age','Are you 18 years or older?',array('class'=>'col-xs-2 col-form-label')) }}
            <div class="col-xs-3">
                {{ Form::checkbox('age',null,array('id'=>'age','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('address', 'Address',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','address', null,array('id'=>'address','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('address2', 'Address 2',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','address2', null,array('id'=>'addres2','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('city', 'City',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','city', null,array('id'=>'city','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('state', 'State',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::select('state', $states,null, array('id' => 'state', 'class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('zip_code', 'Zip Code', array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('text','zip_code', null, array('id'=>'zip_code','class'=>'form-control', 'placeholder'=>'_____-____')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('country', 'Country', array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::select('country', $countries,null, array('id' => 'country', 'class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('student_email', 'ETSU Email',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('email','student_email', null, array('id'=>'student_email','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('student_email2', 'Email 2 (Optional)',array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::input('email','student_email2', null, array('id'=>'student_email2','class'=>'form-control')) }}
            </div>
        </div>

        <button class="cancel_btn btn btn-default" data-toggle="modal" data-target="#cancel_modal">Cancel</button>
        <button type="button" name="next[]"  class="next_btn btn btn-primary">Next</button>

    </fieldset>

<!-- Contact Number -->
    <fieldset>
        <h3> Contact Number
            <button type="button" id="add_contact_no" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
            <button type="button" id="remove_contact_no" class="btn btn-primary"><span class="glyphicon glyphicon-minus"></span></button>
        </h3>
        <hr/>
        <div class="form-frame form-frame-contact">
            <div class="form-group row">
                {{ Form::label('telephone_type', 'Telephone Type',array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    {{ Form::select('telephone_type[]',  $telephone_types, null, array('class' => 'form-control telephone_type')) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('student_phone', 'Telephone',array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    {{ Form::input('text','student_phone[]', null,array('class'=>'form-control student_phone')) }}
                </div>
            </div>
        </div>
        <button type="button" id="previous_btn" class="previous_btn btn btn-info">Previous</button>
        <button type="button"  name="next[]" class="next_btn btn btn-primary">Next</button>

    </fieldset>

<!-- Work experience -->
    <fieldset>
        <h3> Work Experience
            <button type="button" id="add_work_field" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
            <button type="button" id="remove_work_field" class="btn btn-primary"><span class="glyphicon glyphicon-minus"></span></button>
        </h3>
        <hr/>
        <div class="form-frame form-frame-work">
            <div class="form-group row">
                {{ Form::label('company', 'Worked At',array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    {{ Form::input('text','company[]', null, array('class'=>'form-control company')) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('date_left', 'Date Left',array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    <div class="dateInput" name="date_left[]"></div>
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('reason', 'Reason For Leaving',array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    {{ Form::input('text','reason[]', null, array('class'=>'form-control reason')) }}
                </div>
            </div>
        </div>

        <button type="button" id="previous_btn" class="previous_btn btn btn-info">Previous</button>
        <button type="button" name="next[]" class="next_btn btn btn-primary">Next</button>

    </fieldset>

<!-- Education -->
    <fieldset>
        <h3>
            Education
            <button type="button" id="add_education_history" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
            <button type="button" id="remove_education_history" class="btn btn-primary"><span class="glyphicon glyphicon-minus"></span></button>
        </h3>
        <hr/>
        <div class="form-frame form-frame-edu">
            <div class="form-group row">
                {{ Form::label('degree', 'Degree', array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    {{ Form::select('degree[]', $degree_types,null, array('class' => 'form-control degree')) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('institution', 'Institution',array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    {{ Form::input('text','institution[]', null, array('class'=>'form-control')) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('graduation_date', 'Date Graduated',array('class'=>'col-xs-2 col-form-label'))  }}
                <div class="col-xs-3">
                    <div class="form-control dateInput" name="graduation_date[]"></div>
                </div>
            </div>
        </div>
        <button type="button" id="previous_btn" class="previous_btn btn btn-info">Previous</button>
        <button type="button" name="next[]" class="next_btn btn btn-primary">Next</button>
    </fieldset>

<!-- Financial aid -->
    <fieldset>
        <h3>Financial Aid</h3>
        <hr/>
        <div class="form-group row">
            {{ Form::label('worker_type', 'What is the nature of your financial aid?', array('class'=>'col-xs-2 col-form-label'))  }}
            <div class="col-xs-3">
                {{ Form::select('worker_type', $fin_aid_types, null, array('id' => 'worker_type', 'class' => 'form-control', 'multiple'=>'multiple')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('worker_type', 'Select all that apply (Hold ctrl to select more than one, Note: Graduate Assistantship Financial Aid type cannot be selected with any other Financial Aid type)', array('class'=>'col-xs-3'))  }}
        </div>

        <button type="button" id="previous_btn" class="previous_btn btn btn-info">Previous</button>
        <button type="button" name="next[]" class="next_btn btn btn-primary">Next</button>
    </fieldset>

<!-- Availability -->
    <fieldset>
        <h3>
            Availability
            <button type="button" id="add_availability" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
            <button type="button" id="remove_availability" class="btn btn-primary"><span class="glyphicon glyphicon-minus"></span></button>
        </h3>
        <hr/>
        <div class="form-group row">
            {{ Form::label('semester_id', 'Semester',['class'=>'col-xs-2 col-form-label'])  }}
            <div class="col-xs-3">
                {{ Form::select('semester_id', $semesters,null,['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-frame form-frame-availability">
            <div class="form-group row">
                {{ Form::label('weekday_id', 'Weekday',['class'=>'col-xs-2 col-form-label'])  }}
                <div class="col-xs-3">
                    {{ Form::select('weekday_id[]', $weekdays,null, ['class'=>'form-control weekday']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('start_time', 'Start Time',['class'=>'col-xs-2 col-form-label'])  }}
                <div class="col-xs-1">
                    {{ Form::input('text','start_time[]', null, ['class'=>'timepicker']) }}
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('end_time', 'End Time',['class'=>'col-xs-2 col-form-label'])  }}
                <div class="col-xs-1">
                    {{ Form::input('text','end_time[]', null, ['class'=>'timepicker']) }}
                </div>
            </div>
        </div>

        <button type="button" id="previous_btn" class="previous_btn btn btn-info">Previous</button>
        <button type="button"  name="next[]" class="next_btn btn btn-primary">Next</button>
    </fieldset>

<!-- Philosophies -->
    <fieldset>
        <h3>Philosophies</h3>
        <hr/>
        <div class="form-group row">
            {{ Form::label('philosophy_0_2', 'Please describe your philosophy of working with young children 0 -
                    2 years old.',array('class'=>'col-xs-4 col-form-label'))  }}
            <div class="col-xs-4">
                {{ Form::textarea('philosophy_0_2', null, array('id'=>'philosophy_0_2','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('philosophy_3_5', 'Please describe your philosophy of working with young children 3 -
                    5 years old.',array('class'=>'col-xs-4 col-form-label'))  }}
            <div class="col-xs-4">
                {{ Form::textarea('philosophy_3_5', null, array('id'=>'philosophy_3_5','class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group row">
            {{ Form::label('abilities', 'Describe the abilities that qualify you to work effectively with young
                    children.',array('class'=>'col-xs-4 col-form-label'))  }}
            <div class="col-xs-4">
                {{ Form::textarea('abilities', null, array('id'=>'abilities','class'=>'form-control')) }}
            </div>
        </div>

        <button type="button" id="previous_btn" class="previous_btn btn btn-info">Previous</button>
        <button type="button" name="next[]" class="next_btn btn btn-primary">Next</button>
    </fieldset>

<!-- Reference -->
    <fieldset>
        <h3>References</h3>
        <hr/>
        <i>References cannot be family members</i>
        @for($i=1;$i<4;$i++)
            <div class="form-frame">
                <div class="form-group row">
                    {{ Form::label('reference_fname_'.$i, 'First Name',array('class'=>'col-xs-2 col-form-label'))  }}
                    <div class="col-xs-3">
                        {{ Form::input('text','reference_fname_'.$i, null, array('id'=>'reference_fname_'.$i,'class'=>'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('reference_mname_'.$i, 'Middle Name',array('class'=>'col-xs-2 col-form-label'))  }}
                    <div class="col-xs-3">
                        {{ Form::input('text','reference_mname_'.$i, null, array('id'=>'reference_mname_'.$i,'class'=>'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('reference_lname_'.$i, 'Last Name',array('class'=>'col-xs-2 col-form-label'))  }}
                    <div class="col-xs-3">
                        {{ Form::input('text','reference_lname_'.$i, null, array('id'=>'reference_lname_'.$i,'class'=>'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('reference_phone_'.$i, 'Telephone',array('class'=>'col-xs-2 col-form-label'))  }}
                    <div class="col-xs-3">
                        {{ Form::input('text','reference_phone_'.$i, null, array('id'=>'reference_phone_'.$i,'class'=>'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('rreference_email_'.$i, 'Email',array('class'=>'col-xs-2 col-form-label'))  }}
                    <div class="col-xs-3">
                        {{ Form::input('email','reference_email_'.$i, null, array('id'=>'reference_email_'.$i,'class'=>'form-control')) }}
                    </div>
                </div>
            </div>
        @endfor

        <hr/>

        <button type="button" id="previous_btn" class="previous_btn btn btn-info">Previous</button>
        <button type="button" name="next[]" class="next_btn_last btn btn-primary">Next</button>
    </fieldset>

    <fieldset>
        <button type="button" id="edit_btn" class="edit_btn btn btn-info">Edit</button>
        <button type="submit" class="submit_btn btn btn-primary">Submit</button>
    </fieldset>

    {{ Form::close() }}

    @include('pages.modal.cancel')
@endsection