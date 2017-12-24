<?php

namespace App\Http\Requests\Backend\Access\Role;

use App\Http\Requests\Request;

/**
 * Class StoreRoleRequest.
 */
class StoreRoleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-role');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $permissions = '';

        if ($this->associated_permissions != 'all') {
            $permissions = 'required';
        }

        return [
            'name'          => 'required|max:191',
            'permissions'   => $permissions,
        ];
    }

    public function messages()
    {
        return [
            'permissions.required' => 'You must select at least one permission for this role.',
        ];
    }
}
