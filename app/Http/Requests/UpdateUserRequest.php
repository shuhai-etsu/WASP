<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class UpdateUserRequest extends FormRequest
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
     * @todo finish header comments
     * @todo - remove gender_id, alternate_email from type
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
            'first_name'      => 'required|min:1|max:25',
            'last_name'       => 'required|min:1|max:25',
            'gender_id'       => 'required|integer|exists:genders,id,id,'  . $this->get('gender_id'),
            'suffix_id'       => 'required|integer|exists:suffixes,id,id,' . $this->get('suffix_id'),
            'email'           => 'required|email|unique:users,email,' . $this->get('email'),
            'alternate_email' => 'email',
            'comment'         => 'max:255'
        ];
    }
}