/**
* JQuery code which is included in create page of the add certifications  page
* It is executed when the JQuery library has been loaded and elements have been rendered on the browser
**/

$(document).ready(function () {

    //initialise the datepickers
    $("#certified").jqxDateTimeInput({formatString: "MM/dd/yyyy"});
    $("#expiration").jqxDateTimeInput({formatString: "MM/dd/yyyy"});


    //define behavior for the save button
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#certifications').jqxValidator('validate');
     });

    //form action on validation success
    $('#certifications').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //define rules for the jqxvalidator
    $('#certifications').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            {
                input: '#cert',
                message: "Certification is required",
                action: 'change, keyup, blur',
                rule: function (input) {
                    if (input.val() > 1) {
                        return true;
                    } else {
                        return false;
                    }}
            }
        ]
    });
});
