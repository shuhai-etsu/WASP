<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserAvailabilityRequest
 *
 * @todo add class header comments
 * @todo rename as CreateUserAvailabilityRequest
 *
 * @package App\Http\Requests
 */
class UserAvailabilityRequest extends FormRequest
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
     *              required    - Data must be present
     *              min         - Minimum length of 1 character is required.
     *              unique      - Field must be unique (e.g. two abbreviations cannot match). The unique clause checks
     *                            the database (ignoring case) to ensure abbreviations are unique.
     *
     * @return array An array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return
        [
            'semester' => 'required|exists:semesters,id,id,' . $this->get('semester'),
            'weekday'  => 'required|exists:weekdays,id,id,' . $this->get('weekday'),
            'end_time'    => 'required',
            'start_time'  => 'required|before:'. $this->get('end_time'),
            'comment'     => 'max:255'
        ];
    }
}
