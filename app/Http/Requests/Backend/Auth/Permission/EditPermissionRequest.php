<?php

namespace App\Http\Requests\Backend\Auth\Permission;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditPermissionRequest.
 */
class EditPermissionRequest extends FormRequest
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

        ];
    }
}
