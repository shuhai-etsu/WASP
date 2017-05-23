<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class: UpdateCountryRequest
 *
 * Purpose: Class is used to validate an existing Country entry based upon a defined set of rules. The class is called by
 *          the CountryController when a user attempts to update an existing Country.
 *
 * @see CountryController
 *
 * @package App\Http\Requests
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class UpdateCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @todo Additional work is needed for validating users, specifically reviewing the user's security
     * privileges to determine if he/she has access to perform certain tasks.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Method: rules()
     *
     * Purpose: Creates and returns the validation rules that apply to the request. The following validation rules have
     *          be identified as being associated with the request:
     *
     *          ID:
     *              exists      - Entry must exist in the database before it can be updated.
     *
     *          Abbreviation/Description:
     *              required    - Data must be present.
     *              min         - Minimum length of 1 character is required.
     *              unique      - Field must be unique (e.g. two abbreviations cannot match). The unique clause checks
     *                            the database (ignoring case) to ensure abbreviations are unique.
     *
     * CRITICAL: The entry's id must be passed from the submitting request. Otherwise the validation will fail by
     *           throwing unique constraint SQL errors. The id can be passed in several different ways, including adding
     *           a hidden form on the field.
     *
     * @return array An array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return [
            //==========================================================================================================
            //Ensure the entry's id (primary key) is in the database. The syntax uses a WHERE condition
            //to determine if the id of the incoming age group type exists in the database, similar to saying
            //SELECT id from age_group_types WHERE id = {incoming id}.  
            //==========================================================================================================
            'id'            => 'exists:countries,id,id,' . $this->get('id'),
            'abbreviation'  => 'required|min:1|unique:countries,abbreviation,' . $this->get('id'),
            'description'   => 'required|min:1|unique:countries,description,'  . $this->get('id'),
            'comment'       => 'max:255'
        ];
    }
}
