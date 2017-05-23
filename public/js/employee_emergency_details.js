/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in the emergency details section of the application checklist
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function () {
    //mask the telephone number
    $('#telephone_number').jqxMaskedInput({ mask: PHONE_MASK});

    //initialize the jqxdropdown
    $('#relationship_id').jqxDropDownList();

    //define action for save button
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#emergency_contact').jqxValidator('validate');
    });

    //define action on successful validation
    $('#emergency_contact').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //define rules for validating the form
    $('#emergency_contact').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            { input: '#first_name', message: 'First name is required!', action: 'blur', rule: 'required' },
            { input: '#first_name', message: 'First name cannot have numbers!', action: 'keyup, blur', rule: noNumbers},
            { input: '#first_name', message: 'First name cannot be more than '+NAME_MAX+' characters long!', action: 'keyup, blur', rule: 'maxLength='+NAME_MAX},
            { input: '#middle_name', message: 'Middle name cannot have numbers!', action: 'keyup, blur', rule: noNumbers},
            { input: '#middle_name', message: 'Middle name cannot be more than '+NAME_MAX+' characters long!', action: 'keyup, blur', rule: 'maxLength='+NAME_MAX},
            { input: '#last_name', message: 'Last name is required!', action: 'blur', rule: 'required' },
            { input: '#last_name', message: 'Last name cannot have numbers!', action: 'keyup, blur', rule: noNumbers},
            { input: '#last_name', message: 'Last name cannot be more than '+NAME_MAX+' characters long!', action: 'keyup, blur', rule: 'maxLength='+NAME_MAX},
            /*{ input: '#relationship', message: 'Relationship type is required!', action: 'blur', rule: 'required'},*/
            { input: '#telephone_number', message: 'Phone number is invalid!', action: 'valuechanged, blur', rule: 'phone'},
            { input: '#email', message: 'Email is not a valid email!', action: 'blur', rule: 'email'},
        ]
    });

});