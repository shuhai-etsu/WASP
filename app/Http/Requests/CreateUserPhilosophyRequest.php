<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateUserPhilosophyRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class CreateUserPhilosophyRequest extends FormRequest
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
     *
     * @return array An array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return
            [
                'type_id'    => 'required|integer|exists:philosophy_types,id,id,' . $this->get('type_id'),
                'philosophy' => 'required|max:65000'
            ];
    }
}
