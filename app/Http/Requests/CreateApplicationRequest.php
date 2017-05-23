<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateAgeGroupTypeRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */

class CreateApplicationRequest extends FormRequest
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
        return true;
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
     * @todo Either delete or put in the in-line comments where the issue of forms beginning at 0 and database tables beginning at 1 arises (only matters where form field is optional)
     * @todo Fix array validation
     *
     * @return array An array of validation rules that will be used to validate incoming data.
     */
    public function rules()
    {
        return [
            'enumber' => 'required|min:9|max:9',
            'first_name' => 'required|min:1|max:25',
            'middle_name' => 'required|min:1|max:25',
            'last_name' => 'required|min:1|max:25',
            'suffix' => 'integer', //|exists:suffixes,id
            'age' => 'required',
            'address' => 'required|min:2',
            'address2' => 'min:2',
            'city' => 'required|min:2',
            'state' => 'required',
            'zip_code' => 'required|min:5',
            'country' => 'required|min:1|unique:countries,description',
            'student_email' => 'required|email:unique',
            'student_email2' => 'email:unique',

//            'telephone_type.*' => 'required|integer|exists:telephone_types,id',
//            'student_phone.*' => 'required|min:10',
//            'company.*' => 'required|min:2',
//            'date_left.*' =>'required|min:2',
//            'reason.*' => 'required|min:10',
//            'degree.*' => 'required|min:1|unique:degree_types,description',
//            'institution.*' => 'required',
//            'graduation_date.*' => 'required',

            'worker_type' => 'required|min:1|unique:financial_aid_types,description',
            'semester_id' => 'required|integer|exists:semesters,id',

//            'weekday_id.*' => 'required|integer|exists:weekdays,id',
//            'start_time.*' => '',
//            'end_time.*' => '',

            'philosophy_0_2' => 'required|max:65000',
            'philosophy_3_5' => 'required|max:65000',
            'abilities' => 'required|max:65000',
            'reference_fname_1' => 'required',
            'reference_mname_1' => '',
            'reference_lname_1' => 'required',
            'reference_phone_1' => 'required|min:10',
            'reference_email_1' => 'required|email:unique',
            'reference_fname_2' => 'required',
            'reference_mname_2' => '',
            'reference_lname_2' => 'required',
            'reference_phone_2' => 'required|min:10',
            'reference_email_2' => 'required|email:unique',
            'reference_fname_3' => 'required',
            'reference_mname_3' => '',
            'reference_lname_3' => 'required',
            'reference_phone_3' => 'required|min:10',
            'reference_email_3' => 'required|email:unique',


        ];
    }


    public function messages()
    {
        return [
            'enumber.required' => 'Applicant\'s E-number is required',
            'first_name.required' => 'Applicant\'s first name is required',
            'middle_name.required' => 'Applicant\'s middle name is required',
            'last_name.required' => 'Applicant\'s last name is required',

            'age.required' => 'Applicant\'s age must be over 18',
            'address.required' => 'Applicant\'s address is required',

            'city.required' => 'Applicant\'s city required',
            'state.required' => 'Applicant\'s state required',
            'zip_code.required' => 'Applicant\'s zip code required',
            'country.required' => 'Applicant\'s country is required',
            'student_email.required' => 'Applicant\'s email address is required',


            'telephone_type.*.required' => 'Applicant\'s telephone type is required',
            'telephone_type.*.exists' => 'Applicant\'s telephone type is required',
            'student_phone.*.required' => 'Applicant\'s telephone is required',
            'company.*.required' => 'Applicant\'s previous work company is required',
            'date_left.*.required' =>'Applicant\'s date left is required',
            'reason.*.required' => 'Applicant\'s reason for leaving is required',
            'degree.*.required' => 'Applicant\'s degree is required',
            'institution.*.required' => 'Applicant\'s educational institution is required',
            'graduation_date.*.required' => 'Applicant\'s graduation date is required',

            'worker_type.required' => 'Applicant\'s financial aid type(s) is required',



//            'start_time.*.required' => '',
//            'end_time.*.required' => '',

            'philosophy_0_2.required' => 'Applicant\'s philosophy for 0-2 years is required',
            'philosophy_3_5.required' => 'Applicant\'s philosophy for 3-5 years is required',
            'abilities.required' => 'Applicant\'s abilities is required',
            'reference_fname_1.required' => 'Reference 1 first name is required',
            'reference_lname_1.required' => 'Reference 1 last name is required',
            'reference_phone_1.required' => 'Reference 1 telephone is required',
            'reference_email_1.required' => 'Reference 1 email address is required',

            'reference_fname_2.required' => 'Reference 2 first name required',
            'reference_lname_2.required' => 'Reference 2 last name required',
            'reference_phone_2.required' => 'Reference 2 telephone is required',
            'reference_email_2.required' => 'Reference 2 email address is required',

            'reference_fname_3.required' => 'Reference 3 first name required',
            'reference_lname_3.required' => 'Reference 3 last name required',
            'reference_phone_3.required' => 'Reference 3 telephone is required',
            'reference_email_3.required' => 'Reference 3 email address is required',
        ];
    }
}
