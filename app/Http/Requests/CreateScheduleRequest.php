<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreateScheduleRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class CreateScheduleRequest extends FormRequest
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
                'abbreviation'  => 'required|min:1|unique:schedules,abbreviation',
                'description'   => 'required|min:1|unique:schedules,description',
                'semester_id'   => 'required|integer|exists:semesters,id,id,' . $this->get('semester_id'),
                'classroom_id'  => 'required|integer|exists:classrooms,id,id,' . $this->get('classroom_id'),
                'comment'       => 'max:255'
            ];
    }
}
