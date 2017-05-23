<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class: CreateCertificationTypeRequest
 *
 * Purpose: Class is used to validate a new certification type entry based upon a defined set of rules before the entry
 *          is added to the database. The class is called by the AgeGroupTypeController when a user attempts to add a
 *          new age group type to the system.
 *
 * @see CertificationTypeController
 *
 * @package App\Http\Requests
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class CreateCertificationTypeRequest extends FormRequest
{
    /**
     * Method: authorize()
     *
     * Purpose: Determine if the user is authorized to make this request.
     *
     * @todo Checks need to be added to ensure the user has privileges to add new entries.
     *
     * @return bool Boolean value determine if the user has the authority to add a new entry.
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
     *          Abbreviation/Description:
     *              required    - Data must be present
     *              min         - Minimum length of 1 character is required.
     *             unique       - Field must be unique (e.g. two abbreviations cannot match). The unique clause checks
     *                            the database (ignoring case) to ensure abbreviations are unique.
     *
     * @todo why is this method referring to age_group_types?  cf. UpdateCertificationTypeRequest
     *
     * @return array Array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return [
            'abbreviation'  => 'required|min:1|unique:age_group_types,abbreviation',
            'description'   => 'required|min:1|unique:age_group_types,description',
            'comment'       => 'max:255'
        ];
    }
}
