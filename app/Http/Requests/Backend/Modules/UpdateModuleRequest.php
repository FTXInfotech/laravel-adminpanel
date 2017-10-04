<?php

namespace App\Http\Requests\Backend\Modules;

use App\Http\Requests\Request;

/**
 * Class UpdateModuleRequest.
 */
class UpdateModuleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return access()->allow('edit-blog');
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
            'name'  => 'required|max:191|unique:modules,name,'.$this->segment(3).',id',
            'url'   => 'required',
            'view_permission_id' => 'required'
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

        ];
    }
}
