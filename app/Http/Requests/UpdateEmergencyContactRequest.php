<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateEmergencyContactRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class UpdateEmergencyContactRequest extends FormRequest
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
     * @todo   NEED TO FINISH COMMENTS
     *
     * @return array An array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return
            [
                //==========================================================================================================
                //Ensure the entry's id (primary key) is in the database. The syntax uses a WHERE condition
                //to determine if the id of the incoming buildings exists in the database, similar to saying
                //SELECT id from building WHERE id = {incoming id}.
                //==========================================================================================================
                //May need to check this to ensure a new entry is associated with an existing user
                //'user_id'            => 'exists:users,id,id,' . $this->get('user_id'),
                'id'                => 'exists:users_emergency_contacts,id,id,' . $this->get('id'),
                'first_name'        => 'required|min:1|max:25',
                'middle_name'       => 'max:25',
                'last_name'         => 'required|min:1|max:25',
                'suffix_id'         => 'exists:suffixes,id,id,'  . $this->get('suffix_id'),
                'gender_id'         => 'exists:genders,id,id,'  . $this->get('gender_id'),
                'relationship_id'   => 'required|integer|exists:relationships,id,id,' . $this->get('relationship_id'),
                'comment'           => 'max:255'
            ];
    }
}