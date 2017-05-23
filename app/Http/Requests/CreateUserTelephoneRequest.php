<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreateUserTelephoneRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class CreateUserTelephoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @todo - rule check for phone numbers accept invalid values, including 0xx, 1xx, and
     *         reserved like 800, 888, 877, and the x11s that are probably invalid - fix this
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
     * @return array
     */
    public function rules()
    {
        return
        [
            'telephone_number'  => 'required|min:10|max:15',
            'type_id'           => 'required|integer|exists:telephone_types,id,id,' . $this->get('type_id'),
            'comment'           => 'max:255',
            'default_selection' => 'integer',
        ];
    }
}