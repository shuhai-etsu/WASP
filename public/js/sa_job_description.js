/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in the job description section of the application checklist
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */

$(document).ready(function () {

    //define action for the save button
    $('#save-btn').on('click', function () {
        $('#job_description').jqxValidator('validate');
    });

    //reload page on successful validation
    $('#job_description').on('validationSuccess', function (event) {
        location.reload();
    });

    //define rules for jqxvalidator to validate the form
    $('#job_description').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            { input: '#accept_check', message: 'You must accept the terms!', action: 'change', rule: 'required' },
            { input: '#name_signature', message: 'Signature cannot be more than 20 characters long!', action: 'keyup, blur', rule: 'maxLength=20'},
            { input: '#name_signature', message: 'Signature is required!', action: 'blur', rule: 'required' }
        ]
    });

});
