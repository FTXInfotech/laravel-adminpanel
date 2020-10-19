<?php

namespace App\Http\Requests\Backend\Auth\Role;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRoleRequest.
 */
class StoreRoleRequest extends FormRequest
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
            'name' => 'required|max:191|unique:roles,name',
            'permissions' => $permissions,
        ];
    }

    public function messages()
    {
        return [
            'permissions.required' => 'You must select at least one permission for this role.',
        ];
    }
}
