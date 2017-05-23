/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in the drug testing section of the application checklist
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */

$(document).ready(function () {

    //define action for the save button
    $('#save-btn').on('click', function () {
        $('#drug_testing').jqxValidator('validate');
    });

    //define behavior on succesfull validation of the form
    $('#drug_testing').on('validationSuccess', function (event) {
        location.reload();
    });

    //define rules for validating the form
    $('#drug_testing').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            { input: '#accept_check', message: 'You must accept the terms!', action: 'change', rule: 'required' },
            { input: '#name_signature', message: 'Signature cannot be more than 20 characters long!', action: 'keyup, blur', rule: 'maxLength=20'},
            { input: '#name_signature', message: 'Signature is required!', action: 'blur', rule: 'required' }
        ]
    });

});
