/**
* JQuery code which is included in create and edit pages of the edit student personal information page
* It is executed when the JQuery library has been loaded and elements have been rendered on the browser
**/

$(document).ready(function () {
    //define behavior for the save button
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#user_profile').jqxValidator('validate');
     });

    //form action on validation success
    $('#user_profile').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //define rules for the jqxvalidator
    $('#user_profile').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            {input: '#addr1', message: 'Address is required', action: 'blur', rule: 'required'},
            {
                input: '#addr1',
                message: 'Address cannot be more than '+ADD_MAX+' characters long',
                action: 'keyup, blur',
                rule: 'maxLength='+ADD_MAX
            },
            {
                input: '#addr2',
                message: 'Address cannot be more than '+ADD_MAX+' characters long',
                action: 'keyup, blur',
                rule: 'maxLength='+ADD_MAX
            },
            {input: '#city', message: 'City is required', action: 'blur', rule: 'required'},
            {
                input: '#city',
                message: 'City cannot be more than '+NAME_MAX+' characters long',
                action: 'keyup, blur',
                rule: 'maxLength='+NAME_MAX
            },
            {
                input: '#state',
                message: "State is required",
                action: 'change, keyup, blur',
                rule: function (input) {
                    if (input.val() > 0) {
                        return true;
                    } else {
                        return false;
                    }}
            },
            {input: '#telenum', message: 'Telephone number is required', action: 'blur', rule: 'required'},
            {
                input: '#telephone_type',
                message: "Telephone type is required",
                action: 'change, keyup, blur',
                rule: function (input) {
                    if (input.val() > 0) {
                        return true;
                    } else {
                        return false;
                    }}
            }
        ]
    });
});
