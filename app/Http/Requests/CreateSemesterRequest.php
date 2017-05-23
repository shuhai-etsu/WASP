<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class: CreateSemesterRequest
 *
 * Purpose: Class is used to validate a new senester entry based upon a defined set of rules. The class is called
 *          by the SemesterController when a user attempts to add a classroom to the system.
 *
 * @package App\Http\Requests
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class CreateSemesterRequest extends FormRequest
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
     *          Abbreviation/Description:
     *              required        - Data must be present
     *              min             - Minimum length of 1 character is required.
     *              unique          - Field must be unique (e.g. two abbreviations cannot match). The unique clause
     *                                checks the database (ignoring case) to ensure abbreviations are unique.
     *
     *          Default_Selection:
     *              integer         -
     *              min             - Minimum value of zero is allowed, but nothing less than zero. 0 = OFF or NOT
     *                                SELECTED
     *              max             - Maximum value of one is allowed, but no greater. 1 = ON or SELECTED
     *
     * @todo should additional logic be included for validating start_date relative to end_date?
     * @todo fix typo in abbreviation
     *
     * @return array Array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return [
            'abbreviation'      => 'required|min:1|max:10}unique:classrooms,abbreviation',
            'description'       => 'required|min:1|max:100|unique:classrooms,description',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date',
            'comment'           => 'max:255',
            'default_selection' => 'integer|min:0|max:1'
        ];
    }
}
