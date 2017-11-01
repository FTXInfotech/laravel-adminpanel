<?php

namespace App\Http\Requests\Backend\Access\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreUserRequest.
 */
class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => ['required', 'email', 'max:255', Rule::unique('users')],
            'password'   => 'required|min:6|confirmed',
            'state_id'   => 'required',
            'city_id'    => 'required',
            'zip_code'   => 'required|regex:/^[0-9]+$/',
            'ssn'        => 'required|regex:/^[0-9]+$/|max:9|min:9',
        ];
    }

    /**
     * Get the validation massages that apply to the rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'state_id.required' => 'The state field is required.',
            'city_id.required'  => 'The city field is required.',
            'ssn.regex'         => 'The SSN field must be 9 digits.',
            'ssn.min'           => 'The SSN field must be 9 digits.',
            'ssn.max'           => 'The SSN field must be 9 digits.',
            'zip_code.regex'    => 'The zip code field must be digit.',
        ];
    }
}
