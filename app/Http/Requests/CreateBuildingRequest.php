<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;


/**
 * Class: CreateBuldingRequest
 *
 * Purpose: Class is used to validate a new building entry based upon a defined set of rules. The class is called by the
 *          BuildingController when a user attempts to add a new buildng to the system.
 *
 * @todo remove from code base, since buildings won't be tracked?  or, at least, move to a folder for deprecated code.
 *
 * @see BuildingController
 *
 * @package App\Http\Requests
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class CreateBuildingRequest extends FormRequest
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
     *                                checks the database (ignoring case) to ensure building abbreviations are unique.
     *
     *          Address1:
     *              required        - Data must be present
     *              min             - At least one character is required
     *
     *          City:
     *              required        - Data must be present
     *              min             - At least one character is required
     *              max             - Maximum of 25 characters allowed
     *              
     *          State_ID:
     *              required        - Data must be present
     *              integer         - Only integer values are acceptable
     * 
     *          Zipcode:
     *              required        - Data mush be present sent the entry is a foreign key linking back to the States
     *                                table
     *              integer         - Only integer values are acceptable
     * 
     *         Default_Selection:
     *              integer         -
     *              min             - Minimum value of zero is allowed, but nothing less than zero. 0 = OFF or NOT
     *                                SELECTED
     *              max             - Maximum value of one is allowed, but no greater. 1 = ON or SELECTED
     *
     * @todo Consider specified min length other than 1 for address1. 
     * @todo Need to address zipcode issue, since zip code can be in the format xxxx-xxxx. Look at using a prefix and 
     *       postfix or masked edit field
     *
     * @return array Array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return [
            'abbreviation'      => 'required|min:1|max:10|unique:buildings,abbreviation',
            'description'       => 'required|min:1|max:100|unique:buildings,description',
            'address1'          => 'required|min:1|max:100',
            'city'              => 'required|min:1|max:25',
            'state_id'          => 'required|integer|exists:states,id,id' . $this->get('state_id'),
            'zipcode'           => 'required|integer|min:5',
            'comment'           => 'max:255',
            'default_selection' => 'integer',
        ];
    }
}
