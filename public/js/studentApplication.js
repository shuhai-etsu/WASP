/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in the student application page
 *
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */


$(document).ready(function () {

    //initialize masked inputs,time and datepicker
    $(".edit_btn").hide();
    $('.student_phone').jqxMaskedInput({mask: PHONE_MASK});
    $("#reference_phone_1").jqxMaskedInput({mask: PHONE_MASK});
    $("#reference_phone_2").jqxMaskedInput({mask: PHONE_MASK});
    $("#reference_phone_3").jqxMaskedInput({mask: PHONE_MASK});
    $('.dateInput').jqxDateTimeInput({formatString: DATE_FORMAT});
    $('.timepicker').timepicker({
        disableTextInput: true,
        minTime: MIN_TIME_FULL,
        maxTime: MAX_TIME_FULL
    });

    // define rules for validation and
    // validate form fields - for detailed instructions on usage refer to Jquery validation v1.16
    $.validator.addMethod("nameValidation", function(value, element) {
        return this.optional(element) || /^[a-zA-Z-']*$/i.test(value);
    }, "Name can have only letters!");

    $.validator.addMethod("etsuEmail", function(value, element) {
        return this.optional(element) || /@etsu.edu/i.test(value);
    },"Email is not an etsu email!");


    $.validator.addMethod("mustSelect", function(value, element, arg) {
        return arg != value;
    }, "Please select a value!");

    $.validator.addMethod("phoneNumber", function(value, element) {
        var i = /^(?:\(\d{3}\)|\d{3}-)\d{3}-\d{4}$/;
        return this.optional(element) || (i.test(value) > 0);
    }, "Phone Number is invalid!");

    $.validator.addMethod("zipCode", function(value, element) {
        var i = /^\d{5}(?:-\d{4})?$/;
        return this.optional(element) || (i.test(value) > 0);
    }, "Zip Code is invalid!");

    var form = $("#application_form");
    form.validate({
        errorElement: 'span',
        errorClass: 'help-block',
        highlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').addClass("has-error");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass("has-error");
        },
        rules: {
            zip_code: {required: true, zipCode: true},
            student_email: {etsuEmail: true},
            enumber: {required: true, minlength: ENUM_LEN, maxlength: ENUM_LEN},
            first_name: {required: true, maxlength: NAME_MAX/2, nameValidation: true},
            middle_name: {maxlength: NAME_MAX/2,nameValidation: true},
            last_name: {required: true, maxlength: NAME_MAX/2, nameValidation: true},
            age: {required: true},
            address: {required: true, maxlength: NAME_MAX},
            city: {required: true, maxlength: NAME_MAX},
            state: {required: true},

            'telephone_type[]':{mustSelect:"0"},
            'student_phone[]':{phoneNumber:true},
            'company[]': {required:true, maxlength:NAME_MAX},
            'reason[]':{required:true, maxlength:NAME_MAX},
            'degree[]':{mustSelect:"0"},
            'institution[]': {required:true, maxlength:NAME_MAX},

            'worker_type[]':{mustSelect:"0"},

            philosophy_0_2: {required: true, maxlength: PHIL_MAX},
            philosophy_3_5: {required: true, maxlength: PHIL_MAX},
            abilities: { required: true, maxlength: PHIL_MAX},
            reference_fname_1: { required:true, nameValidation: true, maxlength:NAME_MAX/2 },
            reference_mname_1: {nameValidation: true, maxlength:NAME_MAX/2 },
            reference_lname_1: { required:true, nameValidation: true, maxlength:NAME_MAX/2 },
            reference_phone_1: {phoneNumber:true},
            reference_email_1: {required:true, email: true},

            reference_fname_2: { required:true, nameValidation: true, maxlength:NAME_MAX/2 },
            reference_mname_2: {nameValidation: true, maxlength:NAME_MAX/2 },
            reference_lname_2: { required:true, nameValidation: true, maxlength:NAME_MAX/2 },
            reference_phone_2: {phoneNumber:true},
            reference_email_2: {required:true, email: true},

            reference_fname_3: { required:true, nameValidation: true, maxlength:NAME_MAX/2 },
            reference_mname_3: {nameValidation: true, maxlength:NAME_MAX/2 },
            reference_lname_3: { required:true, nameValidation: true, maxlength:NAME_MAX/2 },
            reference_phone_3: {phoneNumber:true},
            reference_email_3: {required:true, email: true}
        },
        messages: {
            zip_code: {required:'Zip Code is required', zipCode: 'Zip code is invalid!'},
            enumber: {
                required: 'Enumber is required!',
                minlength: 'Enumber should be '+ENUM_LEN+' characters long!',
                maxlength: 'Enumber should be '+ENUM_LEN+' characters long!'
            },
            first_name: {
                required: 'First name is required!',
                maxlength: 'First name cannot be more than '+NAME_MAX/2+' characters long!'
            },
            middle_name: {maxlength: 'Middle name cannot be more than '+NAME_MAX/2+' characters long!'},

            last_name: {
                required: 'Last name is required!',
                maxlength: 'Last name cannot be more than '+NAME_MAX/2+' characters long!'
            },
            age: {required: 'You must be over 18 years old!'},
            address: {
                required: 'Address is required!',
                maxlength: 'Address cannot be more than '+NAME_MAX+' characters long!'
            },
            city: {required: 'City is required!', maxlength: 'City cannot be more than '+NAME_MAX+' characters long!'},
            state: {required: 'State is required!'},

            'student_phone[]':{phoneNumber:"Phone Number is invalid!"},
            'company[]': {required:"Company name is required!", maxlength:"Cannot be more than "+NAME_MAX+" characters!"},
            'reason[]':{required:"Reason for leaving is required!", maxlength:"Cannot be more than "+NAME_MAX+" characters!"},

            'institution[]': {required:"Institution name is required!", maxlength:"Cannot be more than "+NAME_MAX+" characters!"},

            'worker_type[]':{mustSelect:"Please select a value!"},

            philosophy_0_2: {required: 'Required!', maxlength: 'Cannot be more than '+PHIL_MAX+' characters!'},
            philosophy_3_5: {required: 'Required!', maxlength: 'Cannot be more than '+PHIL_MAX+' characters!'},
            abilities: {required: 'Required!', maxlength: 'Cannot be more than '+PHIL_MAX+' characters!'},

            reference_fname_1: { required: 'First name is required!', maxlength:'First name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_mname_1: { maxlength:'Middle name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_lname_1: { required: 'Last name is required!', maxlength:'Last name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_phone_1: { phoneNumber:'Phone number is invalid!'},
            reference_email_1: {required:'Email address is required!', email: 'Email address is invalid!'},

            reference_fname_2: { required: 'First name is required!', maxlength:'First name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_mname_2: { maxlength:'Middle name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_lname_2: { required: 'Last name is required!', maxlength:'Last name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_phone_2: { phoneNumber:'Phone number is invalid!'},
            reference_email_2: {required:'Email address is required!', email: 'Email address is invalid!'},

            reference_fname_3: { required: 'First name is required!', maxlength:'First name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_mname_3: { maxlength:'Middle name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_lname_3: { required: 'Last name is required!', maxlength:'Last name cannot be more than '+NAME_MAX/2+' characters long!'},
            reference_phone_3: { phoneNumber:'Phone number is invalid!'},
            reference_email_3: {required:'Email address is required!', email: 'Email address is invalid!'}

        }});
    var current_step, next_step, validation;
    //run validation and goto next section
    $(".next_btn").click(function () {
        form.validate();
        if (form.valid() == true) {
                current_step = $(this).parent();
                next_step = $(this).parent().next();
                current_step.hide();
                next_step.show();
        }
    });
    //go back when "Previous" button is clicked
    $(".previous_btn").click(function () {
        current_step = $(this).parent();
        next_step = $(this).parent().prev();
        current_step.hide();
        next_step.show();
    });

    //Display the entire form and validate when the last next button is clicked
    $(".next_btn_last").click(function () {
        form.validate();
        if (form.valid() == true) {
            $(".edit_btn").show();
            $(".next_btn").hide();
            $(".next_btn_last").hide();
            $(".previous_btn").hide();
            $(".cancel_btn").hide();
            $(this).parent().prevAll().show();
            $(this).parent().nextAll().show();
            $(this).parent().attr("disabled", "disabled");
            $(this).parent().prevAll().attr("disabled", "disabled");
            $(this).hide();
        }
    });

    //Make the form editable
    $(".edit_btn").click(function () {
        $(this).parent().removeAttr("disabled");
        $(this).parent().prevAll().removeAttr("disabled");
    });

    //and disable it when submitted
    $(".submit_btn").click(function (event) {
        $(this).parent().removeAttr("disabled");
        $(this).parent().prevAll().removeAttr("disabled");
    });

    //submit form when it has been validated
    $('#application_form').on('validationSuccess', function (event) {
        $('#application_form').submit();
    });

    //Define contraint for selecting multiple worker types i.e. GA cannot have any other financial aid
    $("#worker_type").change(function(e) {
        var selectedOptions = [];
        $("#worker_type option:selected").each(function(i, selected){
            selectedOptions[i] = $(selected).text();
        });
        for(i=0;i<selectedOptions.length;i++){
            if(selectedOptions[i]=='Graduate Assistantship'){
                $("#worker_type").removeAttr('multiple');
            }
            else{
                $("#worker_type").attr('multiple', 'multiple');
            }
        }
    });

    //enable addition of multiple telephone numbers by adding new elements
    $('#add_contact_no').click(function(){
        $('.form-frame-contact:last').after('<div class="form-frame form-frame-contact"></div>');
        $('.form-frame-contact:last').append('<div class="form-group row"></div>');
        $('.form-frame-contact:last div.row').append('<label for="telephone_type" class="col-xs-2 col-form-label">Telephone Type</label>');
        $('.form-frame-contact:last div.row').append('<div class="col-xs-3"></div>');
        $('.form-frame-contact:first div.row div.col-xs-3 .telephone_type').clone().appendTo('.form-frame-contact:last div.row div.col-xs-3');

        $('.form-frame-contact:last').append('<div class="form-group row"></div>');
        $('.form-frame-contact:last div.row:last').append('<label for="student_phone" class="col-xs-2 col-form-label">Telephone</label>');
        $('.form-frame-contact:last div.row:last').append('<div class="col-xs-3"></div>');
        $('.form-frame-contact:last div.row:last div.col-xs-3').append('<input class="form-control student_phone" name="student_phone[]" type="text">');
       $('.form-frame-contact:last div.row div .student_phone').jqxMaskedInput({mask: PHONE_MASK});
    });

    //user can remove elements as well when desired
    $('#remove_contact_no').click(function(){
        $('.form-frame-contact:last').remove();
    });

    //enable user to add more work fields
    $('#add_work_field').click(function(){
        $('.form-frame-work:last').after('<div class="form-frame form-frame-work"></div>');
        $('.form-frame-work:last').append('<div class="form-group row"></div>');
        $('.form-frame-work:last div.row').append('<label for="company" class="col-xs-2 col-form-label">Worked At</label>');
        $('.form-frame-work:last div.row').append('<div class="col-xs-3"></div>');
        $('.form-frame-work:last div.row:last div.col-xs-3').append('<input class="form-control company" name="company[]" type="text">');

        $('.form-frame-work:last').append('<div class="form-group row"></div>');
        $('.form-frame-work:last div.row:last').append('<label for="left_date" class="col-xs-2 col-form-label">Date Left</label>');
        $('.form-frame-work:last div.row:last').append('<div class="col-xs-3"></div>');
        $('.form-frame-work:last div.row:last div.col-xs-3').append('<div class="form-control datepicker" name="date_left[]"></div>');

        $('.form-frame-work:last').append('<div class="form-group row"></div>');
        $('.form-frame-work:last div.row:last').append('<label for="reason" class="col-xs-2 col-form-label">Reason for leaving</label>');
        $('.form-frame-work:last div.row:last').append('<div class="col-xs-3"></div>');
        $('.form-frame-work:last div.row:last div.col-xs-3').append('<input class="form-control reason" name="reason[]" type="text">');

        $('.form-frame-work:last div.row div .datepicker').jqxDateTimeInput({formatString: DATE_FORMAT});

    });

    //and remove them
    $('#remove_work_field').click(function(){
        $('.form-frame-work:last').remove();
    });

    //enable user to add more of educational background
    $('#add_education_history').click(function(){
        $('.form-frame-edu:last').after('<div class="form-frame form-frame-edu"></div>');
        $('.form-frame-edu:last').append('<div class="form-group row"></div>');
        $('.form-frame-edu:last div.row').append('<label for="degree" class="col-xs-2 col-form-label">Degree</label>');
        $('.form-frame-edu:last div.row').append('<div class="col-xs-3"></div>');
        $('.form-frame-edu:first div.row div.col-xs-3 .degree').clone().appendTo('.form-frame-edu:last div.row div.col-xs-3');

        $('.form-frame-edu:last').append('<div class="form-group row"></div>');
        $('.form-frame-edu:last div.row:last').append('<label for="institution" class="col-xs-2 col-form-label">Institution</label>');
        $('.form-frame-edu:last div.row:last').append('<div class="col-xs-3"></div>');
        $('.form-frame-edu:last div.row:last div.col-xs-3').append('<input class="form-control" name="institution[]" type="text">');

        $('.form-frame-edu:last').append('<div class="form-group row"></div>');
        $('.form-frame-edu:last div.row:last').append('<label for="graduation_date" class="col-xs-2 col-form-label">Date Graduated</label>');
        $('.form-frame-edu:last div.row:last').append('<div class="col-xs-3"></div>');
        $('.form-frame-edu:last div.row:last div.col-xs-3').append('<div class="form-control datepicker" name="graduation_date[]"></div>');

        $('.form-frame-edu:last div.row div .datepicker').jqxDateTimeInput({formatString: DATE_FORMAT});

    });
    //remove educational background fields
    $('#remove_education_history').click(function(){
        $('.form-frame-edu:last').remove();
    });

    //add more availabilities
    $('#add_availability').click(function(){
        $('.form-frame-availability:last').after('<div class="form-frame form-frame-availability"></div>');
        $('.form-frame-availability:last').append('<div class="form-group row"></div>');
        $('.form-frame-availability:last div.row:last').append('<label for="weekday_id" class="col-xs-2 col-form-label">Weekday</label>');
        $('.form-frame-availability:last div.row:last').append('<div class="col-xs-3"></div>');
        $('.form-frame-availability:first div.row div.col-xs-3 .weekday').clone().appendTo('.form-frame-availability:last div.row:last div.col-xs-3');



        $('.form-frame-availability:last').append('<div class="form-group row"></div>');
        $('.form-frame-availability:last div.row:last').append('<label for="start_time" class="col-xs-2 col-form-label">Start Time</label>');
        $('.form-frame-availability:last div.row:last').append('<div class="col-xs-1"></div>');
        $('.form-frame-availability:last div.row:last div.col-xs-1').append('<input class="timepicker" name="start_time[]" type="text">');

        $('.form-frame-availability:last').append('<div class="form-group row"></div>');
        $('.form-frame-availability:last div.row:last').append('<label for="end_time" class="col-xs-2 col-form-label">End Time</label>');
        $('.form-frame-availability:last div.row:last').append('<div class="col-xs-1"></div>');
        $('.form-frame-availability:last div.row:last div.col-xs-1').append('<input class="timepicker" name="end_time[]" type="text">');
        $('.form-frame-availability:last div.row div .timepicker').timepicker({
            disableTextInput: true,
            minTime:MIN_TIME_FULL,
            maxTime:MAX_TIME_FULL
        });
    });

    //and remove them
    $('#remove_availability').click(function(){
        $('.form-frame-availability:last').remove();
    });

});

