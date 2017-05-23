/**
 * Collection of custom validation functions that is used by JQXValidator to validate forms
 *
 */



/**
 * Check if the input date is valid
 * @param input
 * @returns {boolean}
 */
function validDate(input)
{
    var date = $(input).jqxDateTimeInput('value');
    var now= new Date();
    var result = date.getFullYear() >= 1900 && date.getFullYear() <= now.getFullYear();
    return result;
}

/**
 * Check if the input is a valid numeric value
 * @param input
 * @returns {boolean}
 */
function numeric(input)
{
    var val = input.val();
    if (val.match(/\d+/g)!= null){
        return true;
    }else{return false;}
}

/**
 * Check if the input contains any numbers
 * @param input
 * @returns {boolean}
 */
function noNumbers(input)
{
    var val = input.val();
    if (val.match(/^([^0-9]*)$/)){
        return true;
    }
    else { return false;}
}
