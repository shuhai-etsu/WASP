/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in the cellphone guideline page
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 */

$(document).ready(function () {

    //define behavior for what happens when the save button is clicked
    $('#save-btn').on('click', function () {
        $('#phone_guidelines').jqxValidator('validate');
    });

    //action on validation success
    $('#phone_guidelines').on('validationSuccess', function (event) {
        location.reload();
    });

    //validate the form using iqxvalidator
    $('#phone_guidelines').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            { input: '#accept_check', message: 'You must accept the terms!', action: 'change', rule: 'required' },
            { input: '#name_signature', message: 'Signature cannot be more than 20 characters long!', action: 'keyup, blur', rule: 'maxLength=20'},
            { input: '#name_signature', message: 'Signature is required!', action: 'blur', rule: 'required' }
        ]
    });

});
