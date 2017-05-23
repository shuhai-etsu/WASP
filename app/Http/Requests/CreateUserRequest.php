<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateUserRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class CreateUserRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @todo - remove gender_id from this content
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required|min:1|max:25',
            'last_name'     => 'required|min:1|max:25',
            'gender_id'     => 'required|integer|exists:genders,id,id,'  . $this->get('gender_id'),
            'suffix_id'     => 'required|integer|exists:suffixes,id,id,' . $this->get('suffix_id'),
            'email'         => 'required|email:unique',
            'comment'       => 'max:255'
        ];
    }
}
