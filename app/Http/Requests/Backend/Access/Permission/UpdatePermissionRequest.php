<?php

namespace App\Http\Requests\Backend\Access\Permission;

use App\Http\Requests\Request;

/**
 * Class UpdateRoleRequest.
 */
class UpdatePermissionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|max:191',
            'display_name' => 'required|max:191',
        ];
    }
}
