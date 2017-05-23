<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class: CreateClassroomRequest
 *
 * Purpose: Class is used to validate a new classroom entry based upon a defined set of rules. The class is called
 *          by the ClassroomController when a user attempts to add a classroom to the system.
 *
 * @package App\Http\Requests
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class CreateClassroomRequest extends FormRequest
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
     *          Room:
     *              required        - Data must be present
     *              alpha_dash      - Entry can be alpha-numeric, including dashes and underscores
     *
     *          Building_ID:
     *              required        - Data mush be present sent the entry is a foreign key linking back to the Buildings
     *                                table
     *              integer         - Only integer values are acceptable
     *
     *          Default_Selection:
     *              integer         -
     *              min             - Minimum value of zero is allowed, but nothing less than zero. 0 = OFF or NOT
     *                                SELECTED
     *              max             - Maximum value of one is allowed, but no greater. 1 = ON or SELECTED
     *
     * @todo is the curly brace in the abbreviation validation rules a typo?
     *
     * @return array Array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return [
            'abbreviation'      => 'required|min:1|max:10}unique:classrooms,abbreviation',
            'description'       => 'required|min:1|max:100|unique:classrooms,description',
            'minimum_students'  => 'required|integer',
            'maximum_students'  => 'required|integer',
            'comment'           => 'max:255',
            'default_selection' => 'integer|min:0|max:1'
        ];
    }
}
