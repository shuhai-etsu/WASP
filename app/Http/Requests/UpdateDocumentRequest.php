<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class: CreateDocumentRequest
 *
 * Purpose: Class is used to validate a new document entry based upon a defined set of rules before the entry
 *          is added to the database. The class is called by the DocumentsController when a user attempts to add a
 *          new document type to the system.
 *
 * @see DegreeTypeController
 *
 * @package App\Http\Requests
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */

class UpdateDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'name' => 'required|min:1|max:100',
            'type'  => 'required',
            'comments' => 'max:255',
            'expiration_date'=>'required|date|max:10'
        ];
    }
}
