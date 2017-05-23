/**
* JQuery code which is included in create page of the edit student availabilities page
* It is executed when the JQuery library has been loaded and elements have been rendered on the browser
**/

$(document).ready(function () {
    //define behavior for the save button
    $('#save-btn').on('click', function () {
        //to enable client side validation
        event.preventDefault();
        $('#availabilities').jqxValidator('validate');
     });

    //form action on validation success
    $('#availabilities').on('validationSuccess', function (event) {
        $(this).submit();
    });

    //define rules for the jqxvalidator
    $('#availabilities').jqxValidator({
        hintType: 'tooltip',
        animationDuration: 0,
        rules: [
            {
                input: '#semester',
                message: "Semester is required",
                action: 'change, keyup, blur',
                rule: function (input) {
                    if (input.val() > 1) {
                        return true;
                    } else {
                        return false;
                    }}
            },
            {
                input: '#weekday',
                message: "Weekday is required",
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
