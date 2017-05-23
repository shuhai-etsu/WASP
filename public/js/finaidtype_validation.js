/**
 * Created by sauhardad on 2/12/17.
 * JQuery code which is included in the create and edit pages of financial aid types picklist pages
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function () {
    //define behavior when save button is clicked
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#configuration').jqxValidator('validate');
    });

    //reload page on successful validation
    $('#configuration').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //initialize jqxvalidator and define rules for validation
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
            {input: '#max_hours', message: 'Maximum Hours is required!', action: 'blur', rule: 'required'},
            {input: '#max_hours', message: 'Maximum Hours can only have numbers!', action: 'keyup, blur', rule: numeric},
            {
                input: '#max_hours',
                message: 'Maximum Hours cannot be that long!',
                action: 'keyup, blur',
                rule: 'maxLength=3'
            },
            {
                input: '#comments',
                message: 'Comment cannot be more than '+CMNT_MAX+' characters long!',
                action: 'keyup, blur',
                rule: 'maxLength='+CMNT_MAX
            },
        ]
    });
});
