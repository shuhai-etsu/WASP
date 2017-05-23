/**
* JQuery code which is included in create and edit pages of the edit student emergency information page
* It is executed when the JQuery library has been loaded and elements have been rendered on the browser
**/

$(document).ready(function () {
    //define behavior for the save button
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#emergency_contact').jqxValidator('validate');
     });

    //form action on validation success
    $('#emergency_contact').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //define rules for the jqxvalidator
    $('#emergency_contact').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            {input: '#first_name', message: 'First name is required', action: 'blur', rule: 'required'},
            {
                input: '#first_name',
                message: 'First name cannot be more than '+NAME_MAX+' characters long',
                action: 'keyup, blur',
                rule: 'maxLength='+NAME_MAX
            },
            {input: '#first_name', message: 'First name cannot have numbers', action: 'keyup, blur', rule: noNumbers},
            {
                input: '#middle_name',
                message: 'Middle name cannot be more than '+NAME_MAX+' characters long',
                action: 'keyup, blur',
                rule: 'maxLength='+NAME_MAX
            },
            {input: '#middle_name', message: 'Middle name cannot have numbers', action: 'keyup, blur', rule: noNumbers},
            {input: '#last_name', message: 'Last name is required', action: 'blur', rule: 'required'},
            {
                input: '#last_name',
                message: 'Last name cannot be more than '+NAME_MAX+' characters long',
                action: 'keyup, blur',
                rule: 'maxLength='+NAME_MAX
            },
            {input: '#last_name', message: 'Last name cannot have numbers', action: 'keyup, blur', rule: noNumbers},
            {
                input: '#relations',
                message: "Relationship is required",
                action: 'change, keyup, blur',
                rule: function (input) {
                    if (input.val() > 1) {
                        return true;
                    } else {
                        return false;
                    }}
            },
            {input: '#telephone_number', message: 'Telephone number is required', action: 'blur', rule: 'required'},
            {input: '#email', message: 'Email is invalid', action: 'blur', rule: 'email'},
        ]
    });
});
