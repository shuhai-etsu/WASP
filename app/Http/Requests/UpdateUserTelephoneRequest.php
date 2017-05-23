<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

/**
 * Class UpdateUserTelephoneRequest
 *
 * @todo add class header comments
 *
 * @package App\Http\Requests
 */
class UpdateUserTelephoneRequest extends FormRequest
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
                //==========================================================================================================
                //Ensure the entry's id (primary key) is in the database. The syntax uses a WHERE condition
                //to determine if the id of the incoming buildings exists in the database, similar to saying
                //SELECT id from building WHERE id = {incoming id}.
                //==========================================================================================================
                'id'                => 'exists:user_telephones,id,id,' . $this->get('id'),
                'telephone_number'  => 'required|min:10|max:15',
                'type_id'           => 'required|integer|exists:telephone_types,id,id,' . $this->get('type_id'),
                'comment'           => 'max:255',
                'default_selection' => 'integer',
            ];
    }
}
