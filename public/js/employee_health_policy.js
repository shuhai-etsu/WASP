/**
 * Created by sauhardad on 1/29/17.
 * JQuery code which is included in the health policy section of the application checklist
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function () {
    //define what happens when save button is clicked
    $('#save-btn').on('click', function () {
        $('#health_policy').jqxValidator('validate');
    });

    //reload after successful validation
    $('#health_policy').on('validationSuccess', function (event) {
        location.reload();
    });

    //initialize jqxvalidator and define rules for validation
    $('#health_policy').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            { input: '#checkbox_1', message: 'You must accept this!', action: 'change', rule: 'required' },
            { input: '#checkbox_2', message: 'You must accept this!', action: 'change', rule: 'required'},
            { input: '#checkbox_3', message: 'You must accept this!', action: 'change', rule: 'required' },
            { input: '#accept_all', message: 'You must accept this!', action: 'change', rule: 'required' },
            { input: '#name_signature', message: 'Name cannot be more than 20 characters long!', action: 'keyup, blur', rule: 'maxLength=20'},
            { input: '#name_signature', message: 'Abbreviation is required!', action: 'blur', rule: 'required' }
        ]
    });

});
