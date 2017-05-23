/**
 * Created by noama on 11/3/2016.
 * JQuery code which is included in the document upload section of the application checklist
 * It is executed when the JQuery library has been loaded and elements have been rendered on the browser
 *
 */
$(document).ready(function () {
    //init jqxfileupload
    /*$('#jqxFileUpload').jqxFileUpload({
        autoUpload: false
    });*/
    //init dropdown list
    $('#type').jqxDropDownList();
    //init datepicker for certification expiration date
    $('#expiration_date').jqxDateTimeInput({formatString:"MM/dd/yy"});


    //define action for save button
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#upload_document').jqxValidator('validate');
    });

    //define action on successful validation
    $('#upload_document').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //define validation rules for jqxvalidator
    $('#upload_document').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            { input: '#name', message: 'Document Name is required!', action: 'blur', rule: 'required' },
            { input: '#name', message: 'Document Name cannot be more than '+NAME_MAX+' characters long!', action: 'keyup, blur', rule: 'maxLength='+NAME_MAX},
            {
                input: '#type',
                message: "Document type is required",
                action: 'change, keyup, blur',
                rule: function (input) {
                    if (input.val() > 0) {
                        return true;
                    } else {
                        return false;
                    }}
            },
            { input: '#comments', message: 'Comment cannot be more than '+CMNT_MAX+' characters long!', action: 'keyup, blur', rule: 'maxLength='+CMNT_MAX},
        ]
    });

});