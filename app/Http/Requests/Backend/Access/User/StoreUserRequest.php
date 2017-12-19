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
            'first_name'      => 'required|max:255',
            'last_name'       => 'required|max:255',
            'email'           => ['required', 'email', 'max:255', Rule::unique('users')],
            'password'        => 'required|min:6|confirmed',
            'assignees_roles' => 'required',
            'permissions'     => 'required',
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
            'assignees_roles' => 'Please Select Role',
        ];
    }
}
