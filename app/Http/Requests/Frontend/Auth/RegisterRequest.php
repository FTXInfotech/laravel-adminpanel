<?php

namespace App\Http\Requests\Frontend\Auth;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'email'                 => ['required', 'email', 'max:255', Rule::unique('users')],
            'password'              => 'required|min:8|confirmed|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"',
            'state_id'              => 'required',
            'city_id'               => 'required',
            'zip_code'              => 'required',
            'ssn'                   => 'required',
            'is_term_accept'        => 'required',
            'g-recaptcha-response'  => 'required_if:captcha_status,true|captcha',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => trans('validation.required', ['attribute' => 'captcha']),
            'state_id.required'                => 'The state field is required.',
            'city_id.required'                 => 'The city field is required.',
            'password.regex'                   => 'Password must contain at least 1 uppercase letter and 1 number.',
        ];
    }
}
