<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePersonalInfoRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class UpdatePersonalInfoRequest extends FormRequest
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
                'id'              => 'exists:users,id,id,' . $this->get('id'),
                'address1'          => 'required|min:1|max:100',
                'address2'          => 'max:100',
                'city'              => 'required|min:1|max:25',
                'state'          => 'required|integer|exists:states,id,id,' . $this->get('state'),
                'zip'           => 'required|min:5',
                'worker_type'            => 'exists:financial_aid_types,id,id,' . $this->get('worker_type'),
                'telephone_type.*'   => 'required|min:1|unique:telephone_types,description,'  . $this->get('telephone_type.*'),
                'telephone_number.*'  => 'required|min:10|max:15',
                'email'           => 'required|email',
                'alternate_email' => 'email',
                'comment'         => 'max:255'
            ];
    }
}