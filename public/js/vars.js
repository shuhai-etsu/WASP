/**
 * Javascript file that initializes constants for use in other javascript files
 * This list can be synchronized with back end validation using asynchronous calls
 */
//initialize the satformat to be used in datepickers
var DATE_FORMAT="MM/dd/yyyy";

//setup csrf token for asynchronous calls to the server via javascript
$(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
});

//telephone mask for different form fields
var PHONE_MASK ="(###)###-####";

//earliest time selectable for availabilities and scheduling
//a.k.a opening time
var MIN_TIME_FULL = "07:00am";
var MIN_TIME_INT = 7;

//latest time selectable for availabilities and scheduling
//a.k.a closing time
var MAX_TIME_FULL = "5:00pm";
var MAX_TIME_INT = 17;

//maximum length of the number of characters for comment fields
var CMNT_MAX = 255;

//maximum length of "Name" fields
var NAME_MAX=50;

//Maximum length of "Address" fields
var ADD_MAX=100;

//maximum length of "Abbreviation" fields
var ABBR_MAX=10;

//length of enumber
var ENUM_LEN=9;

//maximum number of characters allowed in the philisophies page
var PHIL_MAX = 2000;
