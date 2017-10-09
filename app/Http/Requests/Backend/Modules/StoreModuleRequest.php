<?php

namespace App\Http\Requests\Backend\Modules;

use App\Http\Requests\Request;

/**
 * Class StoreModuleRequest.
 */
class StoreModuleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return access()->allow('create-blog');
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
            'name'           => 'required|max:191|unique:modules',
            'directory_name' => 'required',
            'model_name'     => 'required',
        ];
    }

    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Module Name field is required to be filled',
            'name.max'                  => 'Module Name should not exceed 191 characters',
            'name.unique'               => 'Module Name is already taken',
            'directory_name.required'   => 'Directory Name field is required to be filled',
            'model_name.required'       => 'Model Name field is required to be filled',
        ];
    }
}
