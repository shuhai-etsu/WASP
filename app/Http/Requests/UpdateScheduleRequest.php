<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateScheduleRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class UpdateScheduleRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return
        [
            'id'            => 'exists:schedules,id,id,' . $this->get('id'),
            'abbreviation'  => 'required|min:1|max:25|unique:schedules,abbreviation,' . $this->get('id'),
            'description'   => 'required|min:1|max:100|unique:schedules,description,' . $this->get('id'),
            'semester_id'   => 'required|integer|exists:semesters,id,id,' . $this->get('semester_id'),
            'classroom_id'  => 'required|integer|exists:classrooms,id,id,' . $this->get('classroom_id'),
            'comment'       => 'max:255'
        ];
    }
}
