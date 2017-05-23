/**
* JQuery code which is included in create and edit pages of the classroom picklist
* It is executed when the JQuery library has been loaded and elements have been rendered on the browser
**/

$(document).ready(function () {
    //define behavior for the save button
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#configuration').jqxValidator('validate');
     });

    //form action on validation success
    $('#configuration').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //define rules for the jqxvalidator
    $('#configuration').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            {input: '#description', message: 'Description is required!', action: 'blur', rule: 'required'},
            {input: '#description', message: 'Description cannot have numbers!', action: 'keyup, blur', rule: noNumbers},
            {
                input: '#description',
                message: 'Description cannot be more than '+NAME_MAX+' characters long!',
                action: 'keyup, blur',
                rule: 'maxLength='+NAME_MAX
            },
            {input: '#abbr', message: 'Abbreviation is required!', action: 'blur', rule: 'required'},
            {
                input: '#abbr',
                message: 'Abbreviation cannot be longer than '+ABBR_MAX+' characers!',
                action: 'blur',
                rule: 'maxLength='+ABBR_MAX
            },
            {input: '#minimum_students', message: 'Minimum number of students is required!', action: 'blur', rule: 'required'},
            {input: '#minimum_students', message: 'Minimum number of has to be numeric!', action: 'blur', rule: numeric},
            {input: '#maximum_students', message: 'Maximum number of students is required!', action: 'blur', rule: 'required'},
            {input: '#maximum_students', message: 'Maximum number of has to be numeric!', action: 'blur', rule: numeric},
            {
                input: '#comments',
                message: 'Comment cannot be more than '+CMNT_MAX+' characters long!',
                action: 'keyup, blur',
                rule: 'maxLength='+CMNT_MAX
            },
        ]
    });
});
